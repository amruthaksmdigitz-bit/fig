<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feed;

class FeedsController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $feeds = Feed::with('user', 'images')

            ->when($search, function ($query) use ($search) {

                $query->where('title', 'like', '%' . $search . '%')

                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            })

            ->latest()
            ->paginate(10);

        return view('admin.feeds.index', compact('feeds', 'search'));
    }


    public function show($id)
    {
        $feed = Feed::with('user', 'images')->findOrFail($id);

        return view('admin.feeds.show', compact('feed'));
    }
    
    public function destroy($id)
    {
        $feed = Feed::findOrFail($id);

        $feed->delete();

        return redirect()->route('admin.feeds.index')
            ->with('success', 'Feed deleted successfully');
    }
}
