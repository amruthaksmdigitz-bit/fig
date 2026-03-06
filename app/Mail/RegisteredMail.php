<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $locationName;

    public function __construct(User $user)
    {
        $this->user = $user;
        // Get location name - safely handle missing location
        $this->locationName = optional($user->locationRelation)->name ?? 'Not specified';
    }

    public function build()
    {
        return $this->subject('New User Registration - Furniture International Group')
                    ->view('mails.register_html')
                    ->with([
                        'user' => $this->user,
                        'locationName' => $this->locationName,
                    ]);
    }
}