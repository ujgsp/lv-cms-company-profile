<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $websiteName;
    public $service;

    /**
     * Create a new message instance.
     */
    public function __construct($details, $websiteName, $service)
    {
        $this->details = $details;
        $this->websiteName = $websiteName;
        $this->service = $service;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = '[' . $this->websiteName . '] Quote Mail';

        return $this->subject($subject)
            ->view('mails.quote-mail')
            ->with([
                'details' => $this->details,
                'website_name' => $this->websiteName,
                'service_title' => $this->service,
            ]);
    }
}
