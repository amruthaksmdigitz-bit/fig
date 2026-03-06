<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileUpdateMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function publicProfile($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profile', compact('user'));
    }

    public function ajaxGalleryUpload(Request $request)
    {
        $request->validate([
            'gallery_images.*' => 'required|image|max:4096'
        ]);

        $user = auth()->user();

        $dir = public_path('uploads/user_images');

        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $images = [];

        foreach ($request->file('gallery_images') as $file) {

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move($dir, $filename);

            $path = 'uploads/user_images/' . $filename;

            // save DB if you have gallery table
            $user->multipleImages()->create([
                'image' => $path
            ]);

            $images[] = [
                'url' => asset($path)
            ];
        }

        return response()->json([
            'status' => true,
            'images' => $images
        ]);
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



    public function ajaxImageUpdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'profile_image' => 'nullable|image|max:2048',
            'cover_image'   => 'nullable|image|max:4096',
        ]);

        $type = $request->hasFile('profile_image')
            ? 'profile_image'
            : 'cover_image';

        $file = $request->file($type);

        $folder = $type === 'profile_image'
            ? 'uploads/profiles'
            : 'uploads/covers';

        $path = public_path($folder);

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // delete old
        if ($user->$type && file_exists(public_path($user->$type))) {
            unlink(public_path($user->$type));
        }

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move($path, $filename);

        $user->$type = $folder . '/' . $filename;
        $user->save();

        return response()->json([
            'status' => true,
            'url' => asset($folder . '/' . $filename)
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
            'profile_image' => 'nullable|image|max:10480',
            'cover_image' => 'nullable|image|max:40960',
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

        // === Profile Image ===
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }

            $file = $request->file('profile_image');
            $filename = time() . '_profile_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profiles'), $filename);
            $user->profile_image = 'uploads/profiles/' . $filename;
        }

        // === Cover Image ===
        if ($request->hasFile('cover_image')) {
            if ($user->cover_image && file_exists(public_path($user->cover_image))) {
                unlink(public_path($user->cover_image));
            }

            $file = $request->file('cover_image');
            $filename = time() . '_cover_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/covers'), $filename);
            $user->cover_image = 'uploads/covers/' . $filename;
        }



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
                $filename = time() . '_gallery_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/gallery'), $filename);
                $galleryPaths[] = 'uploads/gallery/' . $filename;
            }

            $user->gallery_images = json_encode($galleryPaths);
        }
        $user->is_approved     = 0;
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
