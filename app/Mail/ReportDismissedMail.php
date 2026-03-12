<?php

namespace App\Mail;

use App\Models\Report;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportDismissedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $report;
    public $recipientType;
    public $adminNotes;

    /**
     * Create a new message instance.
     */
    public function __construct(User $recipient, Report $report, string $recipientType, ?string $adminNotes = null)
    {
        $this->recipient = $recipient;
        $this->report = $report;
        $this->recipientType = $recipientType;
        $this->adminNotes = $adminNotes ?? 'No additional notes provided';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->recipientType === 'reporter' 
            ? 'Update: Your Report Has Been Reviewed'
            : 'Update: A Report About Your Post Has Been Dismissed';

        return $this->subject($subject)
                    ->view('mails.report-dismissed')
                    ->with([
                        'recipientName' => $this->recipient->name,
                        'postTitle' => $this->report->feed ? $this->report->feed->title : 'Deleted Post',
                        'reportMessage' => $this->report->message,
                        'recipientType' => $this->recipientType,
                        'adminNotes' => $this->adminNotes,
                        'reportId' => $this->report->id
                    ]);
    }
}