<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $category = PostCategory::where('slug', 'blog')->first();

        $search = $request->search;

        if (!$category) {

            $blogs = collect([]);
        } else {

            $blogs = Post::with('author')

                ->where('post_category_id', $category->id)

                ->where('published', true)

                ->when($search, function ($query, $search) {

                    $query->where(function ($q) use ($search) {

                        $q->where('title', 'LIKE', "%{$search}%")
                            ->orWhere('body', 'LIKE', "%{$search}%");
                    });
                })

                ->orderBy('created_at', 'desc')

                ->paginate(6)

                ->withQueryString();
        }

        return view('blog', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Post::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();

        $relatedBlogs = Post::where('post_category_id', $blog->post_category_id)
            ->where('id', '!=', $blog->id)
            ->where('published', true)
            ->limit(3)
            ->get();

        return view('blogdetails', compact('blog', 'relatedBlogs'));
    }
}
