<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {

        $credentials = $request->validate([

            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'email', 'max:255'],

            'subject' => ['required', 'string', 'max:255'],

            'message' => ['required', 'string'],

            'captcha' => ['required']

        ]);


        // ✅ IMAGE CAPTCHA VALIDATION (SESSION)

        if ($request->captcha !== session('captcha_code')) {

            return back()->withErrors([

                'captcha' => 'Invalid Captcha'

            ])->withInput();
        }


        try {

            ContactMessage::create([

                'fname' => $credentials['name'],

                'lname' => '',

                'email' => $credentials['email'],

                'subject' => $credentials['subject'],

                'message' => $credentials['message'],

            ]);


            return back()->with('success', 'Your message has been sent!');
        } catch (\Exception $e) {

            Log::error('Contact form submission failed: ' . $e->getMessage());

            return back()->withErrors([

                'error' => 'Failed to send message. Please try again.'

            ])->withInput();
        }
    }

    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('admin.contact_messages.index', compact('messages'));
    }
}
