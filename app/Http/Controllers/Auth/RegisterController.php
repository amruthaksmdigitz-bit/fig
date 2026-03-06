<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisteredMail;
use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
    public function show()
    {

        return view('auth.signup');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([

            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'location' => ['required', 'integer', 'exists:locations,id'],

            'captcha' => ['required'],



        ]);


        // echo "Request Captcha: " . $request->captcha . "<br>";
        // echo "Session Captcha: " . session('captcha_code') . "<br>";
        // exit;

        // CAPTCHA CHECK SAME AS LOGIN

        if ($request->captcha !== session('captcha_code')) {
            return back()->withErrors(['captcha' => 'Invalid captcha']);
        }



        $usercreate = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'location' => $validated['location'],
        ]);

        if ($usercreate) {
            try {
                Mail::to([$request->email,  'iamshafimc@gmail.com'])
                    ->send(new RegisteredMail($usercreate));

                return redirect()->route('login')
                    ->with('success', 'account registered successfully and mail sent.');
            } catch (\Exception $e) {
                Log::error('Mail not sent: ' . $e->getMessage());
            }
        } else {
            return back()->with('error', 'Failed to save user. Please try again.');
        }

        return redirect()->route('login')->with('success', 'Account created! Please log in.');
    }
}
