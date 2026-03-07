<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\FeedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{

    public function index()
    {
        $feeds = Feed::with('user','images')
                    ->latest()
                    ->get();

        return view('feeds',compact('feeds'));
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

        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $image)
            {

                $path = $image->store('feeds','public');

                FeedImage::create([
                    'feed_id' => $feed->id,
                    'image' => $path
                ]);
            }
        }

        return back()->with('success','Post created successfully');
    }
}