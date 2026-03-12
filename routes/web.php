<?php

use App\Http\Controllers\Admin\AdsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventImageController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\WarrantyRegistrationController;
use App\Http\Controllers\Admin\WarrantyController;
use App\Http\Controllers\Admin\VariationController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\LocationsController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\FeedController;
use App\Models\Location;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\FeedsController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\ReportController;

Route::get('/generate-location-slugs', function () {

    $locations = Location::all();

    foreach ($locations as $location) {
        $location->slug = Str::slug($location->name);
        $location->save();
    }

    return "Slugs generated successfully!";
});
Route::get('/feeds', function () {
    return view('feeds');
});
Route::get('/captcha-image', [CaptchaController::class, 'generate'])->name('captcha.image');

Route::get('/captcha', [CaptchaController::class, 'generate'])->name('captcha');

Route::get('/captcha-generate', [CaptchaController::class, 'generate'])
    ->name('captcha.generate');

Route::get('/location/{slug}', [LocationController::class, 'show'])
    ->name('location.show');

Route::prefix('admin')->name('admin.')->group(function () {});

Route::prefix('admin')->middleware(['auth', 'route.access'])->name('admin.')->group(function () {
    Route::prefix('analytics')->name('analytics.')->group(function () {
        Route::get('/dashboard', [AnalyticsController::class, 'dashboard'])->name('dashboard');
        Route::get('/chart-data', [AnalyticsController::class, 'getChartData'])->name('chart');
    });
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');

    // Assign route names to roles
    Route::get('roles/{role}/routes', [RoleController::class, 'editRoutes'])->name('roles.edit_routes');
    Route::post('roles/{role}/routes', [RoleController::class, 'updateRoutes'])->name('roles.update_routes');

    Route::put('roles/{role}/update-name', [RoleController::class, 'updateName'])->name('admin.roles.update_name');



    Route::resource('events', EventController::class);
    // Route::delete('event-images/{id}', [EventImageController::class, 'destroy'])->name('event_images.destroy');

    Route::resource('locations', LocationsController::class);
    Route::resource('ads', AdsController::class);
    Route::get('contact-messages', [ContactController::class, 'index'])
        ->name('contact_messages.index');

    //Route::get('/maintenance/{maintenance}', [MaintenanceController::class, 'show'])->name('maintenance.show');
    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // you can keep adding more admin routes here
    // Route::get('/users', [UserController::class, 'index']);

    // routes/web.php

    Route::resource('post-categories', PostCategoryController::class);
    Route::resource('posts', PostController::class);

    Route::get('users/create', [UserController::class, 'create'])->name('users.create'); // Show create form
    Route::post('users', [UserController::class, 'store'])->name('users.store'); // Handle create form submission
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('users/{id}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::post('users/{id}/approve-profile-update', [UserController::class, 'approveProfileUpdate'])
        ->name('users.approveProfileUpdate');
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);
    Route::post('/users/{user}/unapprove', [UserController::class, 'unapprove'])->name('users.unapprove');

    // OR for toggle route (Option 1)
    Route::post('/users/{user}/toggle-approval', [UserController::class, 'toggleApproval'])->name('admin.users.toggle-approval');
    Route::post('/admin/users/{id}/approve', [App\Http\Controllers\Auth\UserController::class, 'approve'])
        ->name('admin.users.approve');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('page/{slug}', [PageController::class, 'create'])->name('page.create');
    Route::post('page', [PageController::class, 'store'])->name('page.store');
    Route::get('pageview/{id}', [PageController::class, 'show'])->name('page.show');
    Route::get('pagelist/{slug}', [PageController::class, 'index'])->name('page.index');

    Route::get('pageedit/{id}', [PageController::class, 'edit'])->name('page.edit');
    Route::put('pageupdate/{id}', [PageController::class, 'update'])->name('page.update');
    Route::delete('pagedelete/{id}', [PageController::class, 'destroy'])->name('page.destroy');
    Route::post('page/{id}/approve', [PageController::class, 'approve'])->name('page.approve');
});


//feed


Route::get('/feeds', [FeedController::class, 'index'])->name('feeds');

Route::post('/feeds/store', [FeedController::class, 'store'])
    ->middleware('auth')
    ->name('feeds.store');
Route::middleware(['auth'])->group(function () {
    Route::get('/post/{feedId}/images', [FeedController::class, 'getImages'])->name('post.images');
    Route::post('/post/images/add', [FeedController::class, 'addImages'])->name('post.images.add');
    Route::post('/post/images/delete', [FeedController::class, 'deleteImage'])->name('post.images.delete');
    Route::delete('/feeds/{feed}', [FeedController::class, 'destroy'])->name('feeds.destroy');
});
// Frontend blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');


Route::get('/signup', [RegisterController::class, 'show'])->name('signup');
Route::post('/signup', [RegisterController::class, 'register'])->name('signup.post');

// Login and Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Profile Page (only for authenticated users)
// Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');

Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::post('/profile/gallery-upload', [ProfileController::class, 'ajaxGalleryUpload'])
    ->name('profile.gallery.upload');
Route::get('/profile/gallery', [ProfileController::class, 'gallery'])->name('profile.gallery')->middleware('auth');
Route::post('/profile/image-update', [ProfileController::class, 'ajaxImageUpdate'])->middleware('auth')
    ->name('profile.image.update');

// ✅ SETTINGS FIRST
Route::get('/profile/settings', [ProfileController::class, 'settings'])
    ->name('profile.settings');

Route::post('/profile/settings/password', [ProfileController::class, 'updatePassword'])
    ->name('profile.password.update');

// ✅ PUBLIC PROFILE LAST
Route::get('/profile/{username}', [ProfileController::class, 'publicProfile'])
    ->name('profile.show');



Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('home.portfolio');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/furniture', [HomeController::class, 'directorylisting'])->name('home.directorylisting');
Route::get('/events', [HomeController::class, 'events'])->name('home.events');
Route::get('/eventsdetails/{id}', [HomeController::class, 'eventsdetails'])->name('events.details');
Route::get('/product/{slug}', [HomeController::class, 'productdetail'])->name('home.productdetail');
Route::get('/ajax-locations', [HomeController::class, 'searchLocations'])->name('ajax.locations');
Route::get('/locations-search', [LocationController::class, 'search'])
    ->name('locations.search');



Route::get('/search', [UserController::class, 'search'])->name('user.search');
//Route::get('/users', [UserController::class, 'directoryListing'])->name('users.index');


Route::get('/events/{id}', [HomeController::class, 'eventsdetails'])->name('events.details');

/*  Route::get('/services', 'App\Http\Controllers\HomeController@services')->name('home.services');
 Route::get('/gallery', 'App\Http\Controllers\HomeController@gallery')->name('home.gallery');
  Route::get('/offer', 'App\Http\Controllers\HomeController@offer')->name('home.offer');
 Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('home.contact');
  Route::get('/clients', 'App\Http\Controllers\HomeController@clients')->name('home.clients');
   Route::get('/portfolio', 'App\Http\Controllers\HomeController@portfolio')->name('home.portfolio');
   

*/

Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions'); // Create this view
})->name('terms-and-conditions');

Route::get('/privacy-policy', function () {
    return view('privacy-policy'); // Create this view
})->name('privacy-policy');

// Route::get('/userdetails/{id}', [UserDetailsController::class, 'show'])->name('userdetails.show');
Route::get('furniture/{user:slug}', [UserDetailsController::class, 'show'])
    ->name('userdetails.show');


Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/variations', [VariationController::class, 'index'])->name('variations.index');
    Route::get('/variations/create', [VariationController::class, 'create'])->name('variations.create');
    Route::post('/variations/store', [VariationController::class, 'store'])->name('variations.store');
    Route::get('/variations/{id}/edit', [VariationController::class, 'edit'])->name('variations.edit');
    Route::put('/variations/{id}', [VariationController::class, 'update'])->name('variations.update');
    Route::delete('/variations/{id}', [VariationController::class, 'destroy'])->name('variations.destroy');
});



// Route::prefix('admin')->group(function () {

//     Route::get('/feeds', [FeedController::class, 'index'])->name('admin.feeds.index');

//     Route::delete('/feeds/{id}', [FeedController::class, 'destroy'])->name('admin.feeds.delete');
// });

// Route::prefix('admin')->group(function () {

//     Route::get('/feeds', [FeedsController::class, 'index'])->name('admin.feeds.index');

//     Route::get('/admin/feeds/{id}', [FeedsController::class, 'show'])
//         ->name('admin.feeds.show');

//     Route::delete('/feeds/{id}', [FeedsController::class, 'destroy'])->name('admin.feeds.delete');

//     Route::delete('/admin/feed-images/{id}', [FeedsController::class, 'deleteImage'])
//         ->name('admin.feed-images.delete');
// });


Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    Route::prefix('feeds')->name('feeds.')->group(function () {

        Route::get('/', [FeedsController::class, 'index'])->name('index');

        Route::get('/{id}', [FeedsController::class, 'show'])->name('show');

        Route::delete('/{id}', [FeedsController::class, 'destroy'])->name('delete');
    });

    Route::delete('/feed-images/{id}', [FeedsController::class, 'deleteImage'])
        ->name('feed-images.delete');
});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
});


// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->middleware(['auth','route.access'])->name('admin.')->group(function () {

    // ===== FEEDS MANAGEMENT =====
    Route::prefix('feeds')->name('feeds.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\FeedsController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Admin\FeedsController::class, 'show'])->name('show');
        Route::delete('/{id}', [App\Http\Controllers\Admin\FeedsController::class, 'destroy'])->name('delete');
    });

    // ===== FEED IMAGES =====
    Route::delete('/feed-images/{id}', [App\Http\Controllers\Admin\FeedsController::class, 'deleteImage'])
        ->name('feed-images.delete');
});


Route::prefix('admin')->name('admin.')->middleware(['auth','route.access'])->group(function () {

    Route::prefix('reports')->name('reports.')->group(function () {

        Route::get('/', [AdminReportController::class, 'index'])->name('index');

        Route::get('/{id}', [AdminReportController::class, 'show'])->name('show');

        Route::put('/{id}', [AdminReportController::class, 'update'])->name('update');

        Route::delete('/{id}', [AdminReportController::class, 'destroy'])->name('destroy');

        Route::delete('/delete-post/{id}', [AdminReportController::class, 'deletePost'])
            ->name('delete-post');

        Route::post('/hide-post/{id}', [AdminReportController::class, 'hidePost'])
            ->name('hide-post');

        Route::post('/dismiss/{id}', [AdminReportController::class, 'dismissReport'])
            ->name('dismiss');

    });

});

    // ===== OPTIONAL: Add middleware for role-based access if needed =====
    // ->middleware(['route.access']) // Uncomment if you have role-based access

Route::post('/profile/image/update',[ProfileController::class,'ajaxImageUpdate'])
->name('profile.image.update')
->middleware('auth');
