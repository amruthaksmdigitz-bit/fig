<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Feed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileUpdateMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    public function show()
{
    $user = Auth::user();

    $feeds = Feed::with('images')
                ->where('user_id',$user->id)
                ->latest()
                ->get();

    return view('profile', compact('user','feeds'));
}
    public function publicProfile($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profile', compact('user'));
    }

    

public function settings()
{
    $user = auth()->user();
    
    // Fix: Check if location exists and is an object/relationship
    $locationName = null;
    
    // Check if location relation exists and is loaded
    if ($user->location) {
        // If it's a relationship, it should be an object
        if (is_object($user->location)) {
            $locationName = $user->location->name ?? null;
        } else {
            // If it's just an ID, you might need to fetch it manually
            $location = \App\Models\Location::find($user->location);
            $locationName = $location->name ?? null;
        }
    }
    return view('settings', [
        'user' => $user,
        'locationName' => $locationName,
    ]);
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    if (!Hash::check($request->current_password, auth()->user()->password)) {
        return back()->withErrors([
            'current_password' => 'Current password is incorrect',
        ]);
    }

    auth()->user()->update([
        'password' => Hash::make($request->password),
    ]);

    // ✅ redirect + success message
    return redirect()
        ->route('profile')
        ->with('success', 'Password updated successfully');
}

public function gallery()
{
    $user = Auth::user();
    
    // Get images from the relationship instead of JSON fields
    $galleryImages = $user->multipleImages()->latest()->get();
    
    return view('profile_gallery', compact('user', 'galleryImages'));
}



    /*
    ==========================
    GALLERY IMAGE UPLOAD
    ==========================
    */
public function ajaxGalleryUpload(Request $request)
{
    $request->validate([
        'gallery_images.*' => 'required|image|max:20480'
    ]);

    $user = Auth::user();
    $manager = new ImageManager(new Driver());

    $imageDir = public_path('uploads/user_images');
    $thumbDir = public_path('uploads/gallery_thumbnails');

    if (!file_exists($imageDir)) mkdir($imageDir, 0755, true);
    if (!file_exists($thumbDir)) mkdir($thumbDir, 0755, true);

    foreach ($request->file('gallery_images') as $file) {
        $filename = time() . '_' . uniqid() . '.webp';
        
        // === PROCESS MAIN IMAGE (<100KB) ===
        $image = $manager->read($file);
        
        // Resize if too large
        if ($image->width() > 1200 || $image->height() > 1200) {
            $image->scale(width: 1200);
        }
        
        // Save main image with adaptive quality
        $quality = 75;
        $image->toWebp($quality);
        $image->save($imageDir . '/' . $filename);
        
        // Check size and adjust if needed (simple one-time adjustment)
        if (filesize($imageDir . '/' . $filename) > 100 * 1024) {
            $image = $manager->read($file);
            if ($image->width() > 1200 || $image->height() > 1200) {
                $image->scale(width: 1200);
            }
            $image->toWebp(60);
            $image->save($imageDir . '/' . $filename);
        }
        
        // === CREATE THUMBNAIL (target 5-10KB) ===
        // Read the saved main image
        $thumbnail = $manager->read($imageDir . '/' . $filename);
        
        // Create thumbnail at 150x150 (good balance for 5-10KB WebP)
        $thumbnail->cover(150, 150);
        
        // Quality 40-50 usually gives 5-10KB for 150px WebP images
        $thumbnail->toWebp(45);
        $thumbnail->save($thumbDir . '/' . $filename);
        
        // Optional: Verify and adjust if outside range
        $thumbSize = filesize($thumbDir . '/' . $filename) / 1024;
        
        if ($thumbSize > 10) {
            // Too large - reduce quality
            $thumbnail = $manager->read($imageDir . '/' . $filename);
            $thumbnail->cover(150, 150);
            $thumbnail->toWebp(35);
            $thumbnail->save($thumbDir . '/' . $filename);
        } elseif ($thumbSize < 5) {
            // Too small - increase quality slightly
            $thumbnail = $manager->read($imageDir . '/' . $filename);
            $thumbnail->cover(150, 150);
            $thumbnail->toWebp(55);
            $thumbnail->save($thumbDir . '/' . $filename);
        }

        // Save to database
        $user->multipleImages()->create([
            'image' => 'uploads/user_images/' . $filename,
            'thumbnail' => 'uploads/gallery_thumbnails/' . $filename,
        ]);
    }

    return response()->json([
        'status' => true,
        'message' => 'Images uploaded and compressed successfully'
    ]);
}

public function ajaxImageUpdate(Request $request)
{
    $user = auth()->user();
    $manager = new ImageManager(new Driver());

    $request->validate([
        'profile_image' => 'nullable|image|max:2048',
        'cover_image'   => 'nullable|image|max:4096',
    ]);

    // ============================================
    // PROFILE IMAGE UPLOAD
    // ============================================
    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $baseFilename = time() . '_profile_' . uniqid();
        
        // Delete old files
        if ($user->profile_image && file_exists(public_path($user->profile_image))) {
            unlink(public_path($user->profile_image));
        }
        if ($user->profile_thumbnail && file_exists(public_path($user->profile_thumbnail))) {
            unlink(public_path($user->profile_thumbnail));
        }

        // Create directories if they don't exist
        $profileDir = 'uploads/profiles';
        $thumbDir = 'uploads/profile_thumbnails';
        
        if (!file_exists(public_path($profileDir))) {
            mkdir(public_path($profileDir), 0755, true);
        }
        if (!file_exists(public_path($thumbDir))) {
            mkdir(public_path($thumbDir), 0755, true);
        }

        // Read the image
        $image = $manager->read($file);
        
        // Resize if too large (max 800px for profile)
        if ($image->width() > 800 || $image->height() > 800) {
            $image->scale(width: 800);
        }
        
        // Save as WEBP for original (<100KB)
        $originalQuality = 80;
        $originalFilename = $baseFilename . '.webp';
        $originalPath = $profileDir . '/' . $originalFilename;
        
        $image->toWebp($originalQuality);
        $image->save(public_path($originalPath));
        
        // Check size and adjust if >100KB
        $originalSize = filesize(public_path($originalPath)) / 1024;
        
        while ($originalSize > 100 && $originalQuality > 30) {
            $originalQuality -= 10;
            $image = $manager->read($file);
            if ($image->width() > 800 || $image->height() > 800) {
                $image->scale(width: 800);
            }
            $image->toWebp($originalQuality);
            $image->save(public_path($originalPath));
            $originalSize = filesize(public_path($originalPath)) / 1024;
        }
        
        // Create THUMBNAIL (150x150, 5-10KB WEBP)
        $thumbnail = $manager->read($file);
        $thumbnail->cover(150, 150);
        
        $thumbQuality = 50;
        $thumbFilename = $baseFilename . '_thumb.webp';
        $thumbPath = $thumbDir . '/' . $thumbFilename;
        
        $thumbnail->toWebp($thumbQuality);
        $thumbnail->save(public_path($thumbPath));
        
        // Adjust thumbnail size to 5-10KB
        $thumbSize = filesize(public_path($thumbPath)) / 1024;
        
        // If too large (>10KB), reduce quality
        while ($thumbSize > 10 && $thumbQuality > 20) {
            $thumbQuality -= 5;
            $thumbnail = $manager->read($file);
            $thumbnail->cover(150, 150);
            $thumbnail->toWebp($thumbQuality);
            $thumbnail->save(public_path($thumbPath));
            $thumbSize = filesize(public_path($thumbPath)) / 1024;
        }
        
        // If too small (<5KB), increase quality slightly
        while ($thumbSize < 5 && $thumbQuality < 80) {
            $thumbQuality += 5;
            $thumbnail = $manager->read($file);
            $thumbnail->cover(150, 150);
            $thumbnail->toWebp($thumbQuality);
            $thumbnail->save(public_path($thumbPath));
            $thumbSize = filesize(public_path($thumbPath)) / 1024;
        }

        // Save paths to database
        $user->profile_image = $originalPath;
        $user->profile_thumbnail = $thumbPath;
        $user->save();

        return response()->json([
            'status' => true,
            'url' => asset($thumbPath), // Return thumbnail for display
            'original_url' => asset($originalPath), // Original for viewing
            'message' => 'Profile image uploaded successfully'
        ]);
    }

    // ============================================
    // COVER IMAGE UPLOAD
    // ============================================
    if ($request->hasFile('cover_image')) {
        $file = $request->file('cover_image');
        $baseFilename = time() . '_cover_' . uniqid();
        
        // Delete old files
        if ($user->cover_image && file_exists(public_path($user->cover_image))) {
            unlink(public_path($user->cover_image));
        }
        if ($user->cover_thumbnail && file_exists(public_path($user->cover_thumbnail))) {
            unlink(public_path($user->cover_thumbnail));
        }

        // Create directories if they don't exist
        $coverDir = 'uploads/covers';
        $thumbDir = 'uploads/cover_thumbnails';
        
        if (!file_exists(public_path($coverDir))) {
            mkdir(public_path($coverDir), 0755, true);
        }
        if (!file_exists(public_path($thumbDir))) {
            mkdir(public_path($thumbDir), 0755, true);
        }

        // Read the image
        $image = $manager->read($file);
        
        // Resize if too wide (max 1920px width)
        if ($image->width() > 1920) {
            $image->scale(width: 1920);
        }
        
        // Save as WEBP for original (<200KB)
        $originalQuality = 80;
        $originalFilename = $baseFilename . '.webp';
        $originalPath = $coverDir . '/' . $originalFilename;
        
        $image->toWebp($originalQuality);
        $image->save(public_path($originalPath));
        
        // Check size and adjust if >200KB
        $originalSize = filesize(public_path($originalPath)) / 1024;
        
        while ($originalSize > 200 && $originalQuality > 30) {
            $originalQuality -= 10;
            $image = $manager->read($file);
            if ($image->width() > 1920) {
                $image->scale(width: 1920);
            }
            $image->toWebp($originalQuality);
            $image->save(public_path($originalPath));
            $originalSize = filesize(public_path($originalPath)) / 1024;
        }
        
        // Create THUMBNAIL (600x200, <20KB WEBP)
        $thumbnail = $manager->read($file);
        $thumbnail->cover(600, 200);
        
        $thumbQuality = 70;
        $thumbFilename = $baseFilename . '_thumb.webp';
        $thumbPath = $thumbDir . '/' . $thumbFilename;
        
        $thumbnail->toWebp($thumbQuality);
        $thumbnail->save(public_path($thumbPath));
        
        // Adjust thumbnail size to <20KB
        $thumbSize = filesize(public_path($thumbPath)) / 1024;
        
        while ($thumbSize > 20 && $thumbQuality > 30) {
            $thumbQuality -= 10;
            $thumbnail = $manager->read($file);
            $thumbnail->cover(600, 200);
            $thumbnail->toWebp($thumbQuality);
            $thumbnail->save(public_path($thumbPath));
            $thumbSize = filesize(public_path($thumbPath)) / 1024;
        }

        // Save paths to database
        $user->cover_image = $originalPath;
        $user->cover_thumbnail = $thumbPath;
        $user->save();

        return response()->json([
            'status' => true,
            'url' => asset($thumbPath), // Return thumbnail for display
            'original_url' => asset($originalPath), // Original for viewing
            'message' => 'Cover image uploaded successfully'
        ]);
    }

    return response()->json([
        'status' => false,
        'message' => 'No image file provided'
    ]);
}
    public function edit()
    {
        $user = Auth::user();

        $locationName = null;

        if ($user->location) {
            $locationName = DB::table('locations')
                ->where('id', $user->location)
                ->value('name');
        }

        return view('profile_edit', compact('user', 'locationName'));
    }


    public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'location_name' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'gallery_images.*' => 'nullable|image|max:4096',
    ]);

    $oldUserData = $user->getOriginal();

    $user->name = $validated['name'];
    
    if ($request->filled('location_name')) {
        $locationId = DB::table('locations')
            ->where('name', $request->location_name)
            ->value('id');

        if ($locationId) {
            $user->location = $locationId;
        }
    }

    $user->description = $validated['description'] ?? $user->description;

    // === Gallery Images ===
    if ($request->hasFile('gallery_images')) {
        $galleryPaths = [];

        // Delete old gallery images if you want to replace them
        if (!empty($user->gallery_images)) {
            $oldGallery = is_array($user->gallery_images)
                ? $user->gallery_images
                : json_decode($user->gallery_images, true);
            foreach ($oldGallery as $img) {
                if (file_exists(public_path($img))) {
                    unlink(public_path($img));
                }
            }
        }

        foreach ($request->file('gallery_images') as $file) {
            $filename = time() . 'gallery' . $file->getClientOriginalName();
            $file->move(public_path('uploads/gallery'), $filename);
            $galleryPaths[] = 'uploads/gallery/' . $filename;
        }

        $user->gallery_images = json_encode($galleryPaths);
    }
    
    $user->is_approved = 0;
    $user->save();

    \Log::info('Attempting to send email...');

    try {
        \Log::info('Creating mail instance...');
        $mail = new ProfileUpdateMail($user);

        \Log::info('Sending to: impulsedesignersfurniture@gmail.com');

        Mail::to([
            'impulsedesignersfurniture@gmail.com',
            'harshamdigitz@gmail.com',
            'iamshafimc@gmail.com'
        ])->send($mail);

        \Log::info('✅ Mail send method completed without exception');
    } catch (\Exception $e) {
        \Log::error('❌ Mail exception: ' . $e->getMessage());
        \Log::error('Exception trace: ' . $e->getTraceAsString());
    }

    \Log::info('=== UPDATE METHOD COMPLETED ===');

    return redirect()->route('profile')->with('success', 'Profile updated successfully!');
}

}