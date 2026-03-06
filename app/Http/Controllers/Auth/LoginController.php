<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{


    public function showLoginForm()
    {

        return view('auth.login');
    }



    public function login(Request $request)
    {


        $request->validate([

            'email' => ['required', 'email'],

            'password' => ['required'],

            'captcha' => ['required'],

        ]);


        //dd($request->captcha, session('captcha_code'));

        /* CAPTCHA CHECK — SAME AS SIGNUP */

        if ($request->captcha !== session('captcha_code')) {

            return back()->withErrors([

                'captcha' => 'Invalid captcha'

            ])->withInput();
        }



        /* LOGIN */

        if (Auth::attempt([

            'email' => $request->email,

            'password' => $request->password

        ])) {

            $request->session()->regenerate();


            return redirect()->route('profile');
        }



        return back()->withErrors([

            'email' => 'Invalid credentials'

        ])->withInput();
    }




    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->route('login');
    }
}
