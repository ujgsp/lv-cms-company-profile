<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $websiteName;

    /**
     * Create a new message instance.
     */
    public function __construct($details, $websiteName)
    {
        $this->details = $details;
        $this->websiteName = $websiteName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = '[' . $this->websiteName . '] Contact Mail: ' . $this->details['subject'];

        return $this->subject($subject)
            ->view('mails.contact-mail')
            ->with([
                'details' => $this->details,
                'website_name' => $this->websiteName,
            ]);
    }
}
