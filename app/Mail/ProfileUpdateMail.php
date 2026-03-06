<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProfileUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $oldUserData;
    public $updateTime;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, array $oldUserData = [])
    {
        $this->user = $user;
        $this->oldUserData = $oldUserData;
        $this->updateTime = now()->format('F j, Y \a\t g:i A');
    }
    public function build()
    {
        // Generate PDF with Blade view

        return $this->subject('Profile Update - ' . $this->user->name . ' has updated their profile')
                    ->view('mails.profile_update') // beautiful HTML mail view
                    ->with(['user' => $this->user,'oldUserData' => $this->oldUserData]);
                   
    }

}