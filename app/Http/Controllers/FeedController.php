<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\FeedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FeedController extends Controller
{

    public function index()
    {
        $feeds = Feed::with('user', 'images')
            ->latest()
            ->get();

        return view('feeds', compact('feeds'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:20480'
        ]);

        $feed = Feed::create([
            'user_id' => Auth::id(),
            'title' => $request->title
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $path = $image->store('feeds', 'public');

                FeedImage::create([
                    'feed_id' => $feed->id,
                    'image' => $path
                ]);
            }
        }

        return back()->with('success', 'Post created successfully');
    }

    public function getImages($postId)
    {
        $feed = Feed::with('images')->findOrFail($postId);

        // Check if user owns this post
        if ($feed->user_id != auth()->id()) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
        }

        $images = $feed->images->map(function ($image) {
            return [
                'id' => $image->id,
                'url' => asset('storage/' . $image->image)
            ];
        });

        return response()->json(['status' => true, 'images' => $images]);
    }

    /**
     * Add images to an existing post
     */
   

    public function addImages(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:feeds,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $feed = Feed::findOrFail($request->post_id);

        if ($feed->user_id != auth()->id()) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
        }

        foreach ($request->file('images') as $image) {
            $path = $image->store('feeds', 'public');

            FeedImage::create([
                'feed_id' => $feed->id,
                'image' => $path
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Images added successfully']);
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'image_id' => 'required|exists:feed_images,id'
        ]);

        $image = FeedImage::findOrFail($request->image_id);

        if ($image->feed->user_id != auth()->id()) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
        }

        Storage::disk('public')->delete($image->image);
        $image->delete();

        return response()->json(['status' => true, 'message' => 'Image deleted successfully']);
    }

    public function destroy($feedId)
{
    $feed = Feed::findOrFail($feedId);

    if ($feed->user_id != auth()->id()) {
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action'
            ], 403);
        }
        return back()->with('error', 'Unauthorized action');
    }

    try {
        // Delete images from storage
        foreach ($feed->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        // Delete image records
        $feed->images()->delete();
        
        // Delete the post
        $feed->delete();

        // Return JSON response for AJAX requests
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Post deleted successfully'
            ]);
        }

        return back()->with('success', 'Post deleted successfully');
        
    } catch (\Exception $e) {
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete post: ' . $e->getMessage()
            ], 500);
        }
        
        return back()->with('error', 'Failed to delete post');
    }
}
}
