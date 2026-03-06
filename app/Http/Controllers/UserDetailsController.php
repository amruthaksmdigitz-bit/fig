<?php
// App\Http\Controllers\UserDetailsController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function show(User $user)
    {
        $user->load('multipleImages');

        $latestProfiles = User::where('id', '!=', $user->id)
            ->whereNotNull('slug')
            ->latest()
            ->take(3)
            ->get();

        return view('userdetails', compact('user', 'latestProfiles'));
    }
}
