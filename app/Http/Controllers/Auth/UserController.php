<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMultipleimage;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('auth.users.index', compact('users'));
    }
	public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account!');
        }

        // Optional: Check if user has any related data before deleting
        // if ($user->posts()->exists()) {
        //     return redirect()->route('admin.users.index')
        //         ->with('error', 'Cannot delete user with existing posts!');
        // }

        // Delete the user
        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "User '{$userName}' has been deleted successfully!");
    }
	public function unapprove(User $user)
    {
        $user->update(['is_approved' => false]);
        
        // Optional: Send notification email
        // Mail::to($user->email)->send(new UserUnapprovedMail($user));
        
        return redirect()->route('admin.users.index')
            ->with('warning', 'User unapproved successfully!');
    }
    public function directoryListing(Request $request)
    {
        $query = User::query();

        // Filter by location
        if ($request->location) {
            $query->where('location', $request->location);
        }

        if ($request->has('keyword') && $request->keyword) {
            $query->orWhere(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(6)->withQueryString();
        $latestProfiles = User::orderByDesc('id')->take(6)->get();

        $categories = ['slider', 'about-s', 'features', 'counter', 'whychooseus', 'facilities', 'gallery', 'testimonials', 'faq', 'locations', 'banner'];
        $data = [];

        foreach ($categories as $slug) {
            $category = PostCategory::where('slug', $slug)->first();
            if ($category) {
                $catid = $category->id;
                $posts = Post::where('post_category_id', $catid)->get();
                $data[$slug] = in_array($slug, ['slider', 'about-s', 'whychooseus', 'banner']) ? $posts->first() : $posts;
            }
        }


        $locations = Location::all(); // for filter dropdown

        return view('directorylisting', array_merge($data, [
            'users' => $users,
            'latestProfiles' => $latestProfiles,
            
            'locations' => $locations,
        ]));
    }
    public function create()
    {
        $locations = Location::all();
        return view('auth.users.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'nullable|integer|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'multiple_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image
        $profileImageName = null;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_images'), $filename);
            $profileImageName = 'uploads/profile_images/' . $filename;
        }

        
            


        // Handle cover image
        $coverImageName = null;
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/cover_images'), $filename);
            $coverImageName = 'uploads/cover_images/' . $filename;
        }

        // Create the user first
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => $profileImageName,
            'location' => $request->location,
            'description' => $request->description,
            'cover_image' => $coverImageName,
            'is_approved' => 0,
        ]);

        // Handle multiple images upload
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/user_images'), $filename);
                $user->multipleImages()->create([
                    'image' => 'uploads/user_images/' . $filename,
                ]);
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {

        $user->load('multipleImages');
        return view('auth.users.show', compact('user'));
    }

    public function edit(User $user)
    {
		$locations = Location::all();
        $user->load('multipleImages');
        return view('auth.users.edit', compact('user','locations'));
    }

   public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6|confirmed',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'location' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'multiple_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // ✅ Update basic fields safely (NO PASSWORD HERE)
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->location = $validated['location'] ?? null;
    $user->description = $validated['description'] ?? null;

    // ✅ SAFE PASSWORD UPDATE (NO bcrypt)
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // ✅ Reset approval on profile change
    $user->is_approved = 0;

    // ✅ Profile Image Upload
    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/profile_images'), $filename);
        $user->profile_image = 'uploads/profile_images/' . $filename;
    }

    // ✅ Cover Image Upload
    if ($request->hasFile('cover_image')) {
        $file = $request->file('cover_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/cover_images'), $filename);
        $user->cover_image = 'uploads/cover_images/' . $filename;
    }

    // ✅ SAVE USER ONCE
    $user->save();

    // ✅ Handle Multiple Images Upload
    if ($request->hasFile('multiple_images')) {
        foreach ($request->file('multiple_images') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/user_images'), $filename);

            $user->multipleImages()->create([
                'image' => 'uploads/user_images/' . $filename,
            ]);
        }
    }

    return redirect()->route('admin.users.index')
        ->with('success', 'User updated successfully.');
}

public function approve($id)
{
    $user = User::findOrFail($id);

    $user->is_approved = 1;
    $user->save();

    return redirect()->back()->with('success', 'User approved successfully.');
}

}
