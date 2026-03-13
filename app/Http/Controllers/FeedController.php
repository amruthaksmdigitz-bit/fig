<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\FeedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
            'images.*' => 'image|mimes:jpg,jpeg,png|max:20480' // 20MB max
        ]);

        $feed = Feed::create([
            'user_id' => Auth::id(),
            'title' => $request->title
        ]);

        // Handle images if present
        if ($request->hasFile('images')) {
            $this->processAndSaveImages($request->file('images'), $feed);
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'feed_id' => $feed->id,
                'message' => 'Post created successfully'
            ]);
        }

        return back()->with('success', 'Post created successfully');
    }

    /**
     * Process and save images with compression
     */
   private function processAndSaveImages($images, $feed)
{
    $manager = new ImageManager(new Driver());
    
    // Define directories in public storage
    $imageDir = public_path('storage/feeds');           // Already exists
    $thumbDir = public_path('storage/feeds_thumbnail'); // You just created this
    
    // Create thumb directory if it doesn't exist (just in case)
    if (!file_exists($thumbDir)) {
        mkdir($thumbDir, 0755, true);
    }

    foreach ($images as $file) {
        $baseFilename = time() . '_' . uniqid();
        
        // ============================================
        // PROCESS ORIGINAL IMAGE (<100KB WEBP)
        // ============================================
        $image = $manager->read($file);
        
        // Resize if too large (max 1200px width)
        if ($image->width() > 1200) {
            $image->scale(width: 1200);
        }
        
        // Save original as WEBP
        $originalFilename = $baseFilename . '.webp';
        $originalPath = 'feeds/' . $originalFilename;
        
        $quality = 75;
        $image->toWebp($quality);
        $image->save(public_path('storage/' . $originalPath));
        
        // Adjust quality if >100KB
        $originalFullPath = public_path('storage/' . $originalPath);
        while (filesize($originalFullPath) > 100 * 1024 && $quality > 20) {
            $quality -= 10;
            $image = $manager->read($file);
            if ($image->width() > 1200) $image->scale(width: 1200);
            $image->toWebp($quality);
            $image->save($originalFullPath);
        }

        // ============================================
        // CREATE THUMBNAIL (5-10KB WEBP)
        // ============================================
      // ============================================
// CREATE THUMBNAIL (5-10KB WEBP) - SAME NAME
// ============================================
$thumbnail = $manager->read($file);
$thumbnail->cover(300, 300); 


$thumbFilename = $baseFilename . '.webp';  
$thumbPath = 'feeds_thumbnail/' . $thumbFilename;  

$thumbQuality = 50;
$thumbnail->toWebp($thumbQuality);
$thumbnail->save(public_path('storage/' . $thumbPath));
        
          
        $thumbFullPath = public_path('storage/' . $thumbPath);
        $thumbSize = filesize($thumbFullPath) / 1024;
        
        while ($thumbSize > 10 && $thumbQuality > 20) {
            $thumbQuality -= 5;
            $thumbnail = $manager->read($file);
            $thumbnail->cover(300, 300);
            $thumbnail->toWebp($thumbQuality);
            $thumbnail->save($thumbFullPath);
            $thumbSize = filesize($thumbFullPath) / 1024;
        }

        // ============================================
        // SAVE TO DATABASE
        // ============================================
        FeedImage::create([
            'feed_id' => $feed->id,
            'image' => $originalPath,           // 'feeds/filename.webp'
            'thumbnail' => $thumbPath            // 'feeds_thumbnail/filename_thumb.webp'
        ]);
    }
}

      /**
     * New method: Upload images to existing feed
     */
    public function uploadFeedImages(Request $request)
    {
        $request->validate([
            'feed_id' => 'required|exists:feeds,id',
            'images.*' => 'required|image|max:20480' // 20MB max
        ]);

        $feed = Feed::findOrFail($request->feed_id);
        
        // Verify ownership
        if ($feed->user_id !== Auth::id()) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
        }

        $this->processAndSaveImages($request->file('images'), $feed);

        // Get updated images
        $images = $feed->images()->latest()->get()->map(function($image) {
            return [
                'id' => $image->id,
                'url' => asset('storage/' . $image->image),
                'thumbnail' => asset('storage/' . $image->thumbnail)
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Images uploaded successfully',
            'images' => $images
        ]);
    }

    public function getImages($postId)
    {
        $feed = Feed::with('images')->findOrFail($postId);

        // Check if user owns this post (optional - remove if public viewing)
        if ($feed->user_id != auth()->id()) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
        }

        $images = $feed->images->map(function ($image) {
            return [
                'id' => $image->id,
                'url' => asset('storage/' . $image->image),      // Original for lightbox
                'thumbnail' => asset('storage/' . $image->thumbnail) // Thumbnail for grid
            ];
        });

        return response()->json(['status' => true, 'images' => $images]);
    }

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

        $this->processAndSaveImages($request->file('images'), $feed);

        return response()->json([
            'status' => true, 
            'message' => 'Images added successfully'
        ]);
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

        // Delete both original and thumbnail
        Storage::disk('public')->delete($image->image);
        Storage::disk('public')->delete($image->thumbnail);
        
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
            Storage::disk('public')->delete($image->thumbnail);
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
