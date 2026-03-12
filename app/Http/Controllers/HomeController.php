<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\Location;
use App\Models\Feed;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{

		$category = PostCategory::where('slug', 'slider')->first();
		$catid = $category->id;
		$slider = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'slider')->first();
		$catid = $category->id;
		$sliderbanner = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'about-s')->first();
		$catid = $category->id;
		$abouts = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'features')->first();
		$catid = $category->id;
		$features = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'counter')->first();
		$catid = $category->id;
		$counters = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'whychooseus')->first();
		$catid = $category->id;
		$whychooseus = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'facilities')->first();
		$catid = $category->id;
		$facilities = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'gallery')->first();
		$catid = $category->id;
		$gallery = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'testimonials')->first();
		$catid = $category->id;
		$testimonials = Post::where('post_category_id', $catid)->get();


		$category = PostCategory::where('slug', 'faq')->first();
		$catid = $category->id;
		$faq = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'locations')->first();
		$catid = $category->id;
		$locations = Post::where('post_category_id', $catid)->get();

		$users = User::where('is_approved', 1)->get();

		$products = Product::all();
		$locations = Location::all();

		$category = PostCategory::where('slug', 'howitworks')->first();
		$catid = $category->id;
		$howitworks = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'profiledescription')->first();
		$catid = $category->id;
		$profiledescription = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'howitworksdescription')->first();
		$catid = $category->id;
		$howitworksdescription = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'createaccountdescription')->first();
		$catid = $category->id;
		$createaccountdescription = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'blog')->first();
		$catid = $category->id;
		$blog = Post::where('post_category_id', $catid)->get();

		$feeds = Feed::with('user', 'images')
        ->latest()
        ->limit(6)
        ->get();

		return view('index', [
			'feeds'=>$feeds,
			'slider' => $slider,
			'blog' => $blog,
			'sliderbanner' => $sliderbanner,
			'abouts' => $abouts,
			'features' => $features,
			'products' => $products,
			'counters' => $counters,
			'whychooseus' => $whychooseus,
			'facilities' => $facilities,
			'gallery' => $gallery,
			'testimonials' => $testimonials,
			'faq' => $faq,
			'users' => $users,
			'locations' => $locations,
			'howitworks' => $howitworks,
			'profiledescription' => $profiledescription,
			'howitworksdescription' => $howitworksdescription,
			'createaccountdescription' => $createaccountdescription,
		]);
	}
	public static function getphone()
	{

		$category = PostCategory::where('slug', 'phone')->first();
		$catid = $category->id;
		$phone = Post::where('post_category_id', $catid)->first();
		return $phone;
	}
	public static function getphone1()
	{

		$editpost = PostCategory::where('slug', 'phone')->first();
		$catid = $editpost->id;
		$phone = Post::where('post_category_id', $catid)->first();
		return $phone->phone1;
	}

	public static function getemail()
	{

		$editpost = PostCategory::where('slug', 'email')->first();
		$catid = $editpost->id;
		$email = Post::where('post_category_id', $catid)->first();
		return $email;
	}
	public static function getemail1()
	{

		$editpost = PostCategory::where('slug', 'email')->first();
		$catid = $editpost->id;
		$email = Post::where('post_category_id', $catid)->first();
		return $email->title;
	}
	public static function getalladdress()
	{

		$editpost = PostCategory::where('slug', 'address')->first();
		$catid = $editpost->id;
		$address = Post::where('post_category_id', $catid)->first();
		return $address;
	}

	public static function getsocialicons()
	{
		$editpost = PostCategory::where('slug', 'social-icons')->first();
		$catid = $editpost->id;
		$socialicons = Post::where('post_category_id', $catid)->get();
		return $socialicons;
	}

	public static function getaddress()
	{

		$editpost = PostCategory::where('slug', 'address')->first();
		$catid = $editpost->id;
		$address = Post::where('post_category_id', $catid)->first();
		return $address->address1;
	}
	public static function getlogo()
	{

		$editpost = PostCategory::where('slug', 'logo')->first();
		$catid = $editpost->id;
		$logo = Post::where('post_category_id', $catid)->first();
		return $logo;
	}
	public function about()
	{



		$category = PostCategory::where('slug', 'slider')->first();
		$catid = $category->id;
		$slider = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'about-s')->first();
		$catid = $category->id;
		$abouts = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'features')->first();
		$catid = $category->id;
		$features = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'banner')->first();
		$catid = $category->id;
		$banner = Post::where('post_category_id', $catid)->first();

		return view('about', [

			'slider' => $slider,

			'abouts' => $abouts,

			'banner' => $banner,
			'features' => $features,

		]);
	}



	public function portfolio()
	{
		$editpost = PostCategory::where('slug', 'gallery')->first();
		$catid = $editpost->id;
		$gallerys = Post::where('post_category_id', $catid)->get();


		return view('portfolio', [
			'gallery' => $gallerys
		]);
	}
	public function Contact()
	{


		$category = PostCategory::where('slug', 'phone')->first();
		$catid = $category->id;
		$phone = Post::where('post_category_id', $catid)->first();



		$category = PostCategory::where('slug', 'email')->first();
		$catid = $category->id;
		$email = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'email')->first();
		$catid = $category->id;
		$allemails = Post::where('post_category_id', $catid)->get();

		$editpost = PostCategory::where('slug', 'address')->first();
		$catid = $editpost->id;
		$address = Post::where('post_category_id', $catid)->first();



		$editpost = PostCategory::where('slug', 'social-icons')->first();
		$catid = $editpost->id;
		$socialicons = Post::where('post_category_id', $catid)->get();



		$category = PostCategory::where('slug', 'slider')->first();
		$catid = $category->id;
		$slider = Post::where('post_category_id', $catid)->first();



		return view('contact', [

			'address' => $address,
			'socialicons' => $socialicons,
			'email' => $email,
			'phone' => $phone,
			'allemails' => $allemails,
			'slider' => $slider,
		]);
	}

	public function productdetail($slug)
	{
		$product = Product::where('slug', $slug)->firstOrFail();

		return view('productdetail', compact('product'));
	}



	public function directorylisting(Request $request)
	{
		$users = User::where('is_approved', 1);

		// 🔍 Name Search
		if ($request->filled('search')) {
			$users->where('name', 'LIKE', '%' . $request->search . '%');
		}

		// 📍 Location Filter ✅ FIXED
		if ($request->filled('location')) {
			$users->where('location_id', $request->location);
		}

		$users = $users->orderBy('id', 'desc')
			->paginate(12)
			->withQueryString();

		$latestProfiles = User::where('is_approved', 1)
			->orderBy('id', 'desc')
			->limit(5)
			->get();

		$bannerCategory = PostCategory::where('slug', 'banner')->first();

		$banner = $bannerCategory
			? Post::where('post_category_id', $bannerCategory->id)->first()
			: null;

		return view('listing', compact(
			'users',
			'latestProfiles',
			'banner'
		));
	}



	public function events()
	{
		// ✅ Get banner for hero section
		$bannerCategory = PostCategory::where('slug', 'banner')->first();
		$banner = $bannerCategory
			? Post::where('post_category_id', $bannerCategory->id)->first()
			: null;

		// ✅ Get events with pagination (matches your blade)
		$events = Event::latest()->paginate(6);

		return view('events', compact('events', 'banner'));
	}

	public function eventsdetails($id)
	{
		$event = Event::findOrFail($id);
		return view('eventsdetails', compact('event'));
	}

	// AJAX Location Search for Select2
	public function searchLocations(Request $request)
	{
		$search = $request->term;

		$locations = Location::where('name', 'LIKE', '%' . $search . '%')
			->orderBy('name')
			->limit(10)
			->get();

		$data = [];

		foreach ($locations as $location) {
			$data[] = [
				'id' => $location->id,
				'text' => $location->name
			];
		}

		return response()->json($data);
	}
}
