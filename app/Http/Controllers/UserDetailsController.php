<?php
// App\Http\Controllers\UserDetailsController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feed; // Add this import
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function show(User $user)
    {
        
        $user->load(['multipleImages', 'location']);
        
        $feeds = Feed::with('images')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();
        
        $latestProfiles = User::where('id', '!=', $user->id)
            ->whereNotNull('slug')
            ->latest()
            ->take(3)
            ->get();

        return view('userdetails', compact('user', 'feeds', 'latestProfiles'));
    }
}