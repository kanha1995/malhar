<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactPartner extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Partner Communication')
                    ->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
                    ->cc(env('MAIL_CC_EMAIL'), env('MAIL_CC_NAME'))
                    ->replyTo(env('MAIL_REPLAY_TO_EMAIL'), env('MAIL_REPLAY_TO_NAME '))
                    ->view('emails.ContactPartner')
                    ->with('details', $this->details);
    }
}
