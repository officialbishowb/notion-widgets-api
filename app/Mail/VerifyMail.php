<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $verify_url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url){
        $this->verify_url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Verify your email address")
        ->markdown('emails.verify_email');
    }
}
