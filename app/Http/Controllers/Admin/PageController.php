<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
       $posts = Post::join('post_categories', 'posts.post_category_id', '=', 'post_categories.id')
    ->where('post_categories.slug', $slug)
    ->with('category')   // eager-load for later use
    ->select('posts.*')  // avoid column collisions
    ->latest()
    ->paginate(10);
       return view('admin.pages.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($slug)
    {
         $category = PostCategory::where('slug', $slug)->first();
         $categoryId = $category?->id;   // null-safe
          $categories = PostCategory::pluck('name', 'id');
        return view('admin.pages.create', compact('categories','categoryId','slug'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'nullable|string',
        'post_category_id' => 'required|exists:post_categories,id',
        'image' => 'nullable|image|max:2048',
        'highlighted_image' => 'nullable|image|max:2048',
    ]);
    
    // Generate slug
    $slug = Str::slug($validated['title']);
    $original = $slug;
    $count = 2;
    while (Post::where('slug', $slug)->exists()) {
        $slug = $original . '-' . $count++;
    }
    $validated['slug'] = $slug;
    
    // Handle REGULAR image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        // Move to public/posts directory
        $image->move(public_path('posts'), $imageName);
        $validated['image'] = 'posts/' . $imageName;
    }
    
    // **FIXED: Handle HIGHLIGHTED image upload PROPERLY**
    if ($request->hasFile('highlighted_image')) {
        $highlightedImage = $request->file('highlighted_image');
        $highlightedName = 'banner_' . time() . '_' . $highlightedImage->getClientOriginalName();
        
        // DEBUG: Check file info
        \Log::info('Highlighted image upload:', [
            'original_name' => $highlightedImage->getClientOriginalName(),
            'temp_path' => $highlightedImage->getPathname(),
            'size' => $highlightedImage->getSize(),
            'mime_type' => $highlightedImage->getMimeType(),
        ]);
        
        // Move to public/posts directory
        $highlightedImage->move(public_path('posts'), $highlightedName);
        $validated['highlighted_image'] = 'posts/' . $highlightedName;
        
        \Log::info('Highlighted image saved to:', [
            'path' => 'posts/' . $highlightedName,
            'full_path' => public_path('posts/' . $highlightedName),
            'file_exists' => file_exists(public_path('posts/' . $highlightedName)),
        ]);
    } else {
        \Log::info('No highlighted image file in request');
        $validated['highlighted_image'] = null;
    }
    
    $validated['published'] = $request->has('published');
    
    // Save to database
    $post = Post::create($validated);
    
    return redirect()->route('admin.page.show', $post->id)
        ->with('success', 'Post created successfully.');
}
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       
         $post = Post::where('id', $id)->first();
         $category = PostCategory::where('id', $post->post_category_id)->first();
          $slug= $category->slug;
        return view('admin.pages.show', compact('post','slug'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $categories = PostCategory::pluck('name', 'id');
           $post = Post::where('id', $id)->first();
          $category = PostCategory::where('id', $post->post_category_id)->first();
          $slug= $category->slug;
        return view('admin.pages.edit', compact('post', 'categories','slug'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);
    
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'nullable|string',
        'post_category_id' => 'required|exists:post_categories,id',
        'image' => 'nullable|image|max:2048',
        'highlighted_image' => 'nullable|image|max:2048',
        'published' => 'sometimes',
    ]);
    
    // Generate new slug if title changed
    if ($post->title !== $validated['title']) {
        $slug = Str::slug($validated['title']);
        $original = $slug;
        $count = 2;
        while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug = $original . '-' . $count++;
        }
        $validated['slug'] = $slug;
    }
    
    // Handle REGULAR image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }
        
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('posts'), $imageName);
        $validated['image'] = 'posts/' . $imageName;
    }
    
    // **FIXED: Handle HIGHLIGHTED image upload PROPERLY**
    if ($request->hasFile('highlighted_image')) {
        // Delete old highlighted image if exists
        if ($post->highlighted_image && file_exists(public_path($post->highlighted_image))) {
            unlink(public_path($post->highlighted_image));
        }
        
        $highlightedImage = $request->file('highlighted_image');
        $highlightedName = 'banner_' . time() . '_' . $highlightedImage->getClientOriginalName();
        
        // Move to public/posts directory
        $highlightedImage->move(public_path('posts'), $highlightedName);
        $validated['highlighted_image'] = 'posts/' . $highlightedName;
        
        \Log::info('Highlighted image updated:', [
            'post_id' => $post->id,
            'old_path' => $post->highlighted_image,
            'new_path' => 'posts/' . $highlightedName,
        ]);
    }
    
    $validated['published'] = $request->has('published');
    
    // Update the post
    $post->update($validated);
    
    return redirect()->route('admin.page.show', $post->id)
        ->with('success', 'Post updated successfully.');
}
    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    $post = Post::find($id);
    
    if (!$post) {
        return redirect()->route('admin.posts.index')->with('error', 'Post not found.');
    }
    
    // Delete regular image if exists
    if ($post->image) {
        // Check if it's stored in storage or public directory
        if (strpos($post->image, 'storage/') === 0) {
            // For storage: convert "storage/posts/image.jpg" to "posts/image.jpg"
            $imagePath = str_replace('storage/', '', $post->image);
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        } else {
            // For public directory
            if (file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }
        }
    }
    
    // Delete highlighted image if exists
    if ($post->highlighted_image) {
        // Check if it's stored in storage or public directory
        if (strpos($post->highlighted_image, 'storage/') === 0) {
            // For storage: convert "storage/posts/highlighted.jpg" to "posts/highlighted.jpg"
            $highlightedPath = str_replace('storage/', '', $post->highlighted_image);
            if (Storage::disk('public')->exists($highlightedPath)) {
                Storage::disk('public')->delete($highlightedPath);
            }
        } else {
            // For public directory
            if (file_exists(public_path($post->highlighted_image))) {
                unlink(public_path($post->highlighted_image));
            }
        }
    }

    $post->delete(); 
    
    // After deleting, redirect to posts index, not show page
    return redirect()->route('admin.posts.index')
                     ->with('success', 'Post deleted successfully.');
}

public function approve($id)
{
    $post = Page::findOrFail($id);
    $post->is_approved = 1;
    $post->save();

    // Optional: send email to notify user or admin
    // Mail::to($post->user->email)->send(new PageApproved($post));

    return redirect()->back()->with('success', 'Profile description approved successfully.');
}

}
