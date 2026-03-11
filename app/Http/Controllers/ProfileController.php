<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Feed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();

        $feeds = Feed::with('images')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('profile', compact('user','feeds'));
    }


    public function publicProfile($username)
    {
        $user = User::where('slug', $username)->firstOrFail();

        return view('profile', compact('user'));
    }


    public function settings()
    {
        $user = auth()->user();

        $locationName = null;

        if ($user->location) {

            $location = \App\Models\Location::find($user->location);

            $locationName = $location->name ?? null;
        }

        return view('settings', compact('user','locationName'));
    }


    public function updatePassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required','confirmed','min:8'],
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {

            return back()->withErrors([
                'current_password' => 'Current password is incorrect',
            ]);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile')
            ->with('success','Password updated successfully');
    }



    /*
    ==========================
    GALLERY PAGE
    ==========================
    */

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
        'gallery_images.*' => 'required|image|max:20480' // 20MB max
    ]);

    $user = Auth::user();

    $manager = new ImageManager(new Driver());

    $imageDir = public_path('uploads/user_images');
    $thumbDir = public_path('uploads/gallery_thumbnails');

    if (!file_exists($imageDir)) mkdir($imageDir, 0755, true);
    if (!file_exists($thumbDir)) mkdir($thumbDir, 0755, true);

    foreach ($request->file('gallery_images') as $file) {
        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Save original
        $file->move($imageDir, $filename);

        // Create thumbnail (300x300)
        $image = $manager->read($imageDir . '/' . $filename);
        $image->cover(300, 300);
        $image->save($thumbDir . '/' . $filename);

        // Save both original and thumbnail in DB
        $user->multipleImages()->create([
            'image' => 'uploads/user_images/' . $filename,
            'thumbnail' => 'uploads/gallery_thumbnails/' . $filename,
        ]);
    }

    return response()->json([
        'status' => true,
        'message' => 'Images uploaded successfully'
    ]);
}

    public function edit()
    {
        $user = Auth::user();

        $locationName = null;

        if ($user->location) {

            $locationName = DB::table('locations')
                ->where('id',$user->location)
                ->value('name');
        }

        return view('profile_edit', compact('user','locationName'));
    }



    /*
    ==========================
    PROFILE UPDATE
    ==========================
    */

    public function update(Request $request)
    {

        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'profile_image' => 'nullable|image|max:10480',
            'cover_image' => 'nullable|image|max:40960',
        ]);

        $user->name = $validated['name'];


        /*
        LOCATION
        */

        if ($request->filled('location_name')) {

            $locationId = DB::table('locations')
                ->where('name', $request->location_name)
                ->value('id');

            if ($locationId) {

                $user->location = $locationId;
            }
        }


        $user->description = $validated['description'] ?? $user->description;


        $manager = new ImageManager(new Driver());


        /*
        PROFILE IMAGE
        */

        if ($request->hasFile('profile_image')) {

            if ($user->profile_image && file_exists(public_path($user->profile_image))) {

                unlink(public_path($user->profile_image));
            }

            if ($user->profile_thumbnail && file_exists(public_path($user->profile_thumbnail))) {

                unlink(public_path($user->profile_thumbnail));
            }

            $file = $request->file('profile_image');

            $filename = time().'_profile_'.uniqid().'.'.$file->getClientOriginalExtension();

            $profileDir = public_path('uploads/profiles');

            if (!file_exists($profileDir)) {

                mkdir($profileDir,0755,true);
            }

            $file->move($profileDir,$filename);

            $user->profile_image = 'uploads/profiles/'.$filename;


            /*
            PROFILE THUMBNAIL
            */

            $thumbDir = public_path('uploads/profile_thumbnails');

            if (!file_exists($thumbDir)) {

                mkdir($thumbDir,0755,true);
            }

            $image = $manager->read($profileDir.'/'.$filename);

            $image->cover(150,150);

            $image->save($thumbDir.'/'.$filename);

            $user->profile_thumbnail = 'uploads/profile_thumbnails/'.$filename;
        }



        /*
        COVER IMAGE
        */

        if ($request->hasFile('cover_image')) {

            if ($user->cover_image && file_exists(public_path($user->cover_image))) {

                unlink(public_path($user->cover_image));
            }

            if ($user->cover_thumbnail && file_exists(public_path($user->cover_thumbnail))) {

                unlink(public_path($user->cover_thumbnail));
            }

            $file = $request->file('cover_image');

            $filename = time().'_cover_'.uniqid().'.'.$file->getClientOriginalExtension();

            $coverDir = public_path('uploads/covers');

            if (!file_exists($coverDir)) {

                mkdir($coverDir,0755,true);
            }

            $file->move($coverDir,$filename);

            $user->cover_image = 'uploads/covers/'.$filename;


            /*
            COVER THUMBNAIL
            */

            $thumbDir = public_path('uploads/cover_thumbnails');

            if (!file_exists($thumbDir)) {

                mkdir($thumbDir,0755,true);
            }

            $image = $manager->read($coverDir.'/'.$filename);

            $image->cover(600,200);

            $image->save($thumbDir.'/'.$filename);

            $user->cover_thumbnail = 'uploads/cover_thumbnails/'.$filename;
        }


        $user->is_approved = 0;

        $user->save();

        return redirect()->route('profile')
            ->with('success','Profile updated successfully!');

    }

}