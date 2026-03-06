<?php
namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\PostCategory;
class LocationController extends Controller
{
   public function show(Request $request, $slug)
{
        
		$location = Location::where('slug', $slug)->firstOrFail();
		
		$users = User::where('is_approved', 1)
		->where('location_id', $location->id);

		// 🔍 Name Search
		if ($request->filled('search')) {
			$users->where('name', 'LIKE', '%' . $request->search . '%');
		}

		// 📍 Location Filter ✅ FIXED
		if ($request->filled('location')) {
			$users->where('location', $request->location);
		}

		$users = $users->orderBy('id', 'desc')->paginate(12)->withQueryString();

		$latestProfiles = User::where('is_approved', 1)
			->orderBy('id', 'desc')
			->limit(5)
			->get();

		$locations = Location::orderBy('name')->get();

		$bannerCategory = PostCategory::where('slug', 'banner')->first();
		$banner = $bannerCategory
			? Post::where('post_category_id', $bannerCategory->id)->first()
			: null;

		return view('location.show', compact(
			'users',
			'latestProfiles',
			'locations',
			'banner',
			'location'
		));
	}

public function search(Request $request)
{
    $search = $request->search;

    $locations = Location::query()
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        })
        ->limit(20)
        ->get(['id', 'name']);

    return response()->json($locations);
}

}
?>