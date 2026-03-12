<?php

namespace App\Mail;

use App\Models\Report;
use App\Models\Feed;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostDeletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $feed;
    public $report;
    public $recipientType;

    /**
     * Create a new message instance.
     */
    public function __construct(User $recipient, Feed $feed, Report $report, string $recipientType)
    {
        $this->recipient = $recipient;
        $this->feed = $feed;
        $this->report = $report;
        $this->recipientType = $recipientType;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->recipientType === 'reporter' 
            ? 'Update: The Post You Reported Has Been Deleted'
            : 'Important: Your Post Has Been Deleted';

        return $this->subject($subject)
                    ->view('mails.post-deleted')
                    ->with([
                        'recipientName' => $this->recipient->name,
                        'postTitle' => $this->feed->title,
                        'reportMessage' => $this->report->message,
                        'recipientType' => $this->recipientType,
                        'adminNotes' => $this->report->admin_notes ?? 'No additional notes provided'
                    ]);
    }
}