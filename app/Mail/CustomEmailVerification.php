<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class CustomEmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $verificationUrl
     * @return void
     */
    public function __construct($user, $verificationUrl)
    {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewInBrowserUrl = route('email.verification.view', [
            'id' => $this->user->id,
            'hash' => sha1($this->user->getEmailForVerification()),
        ]);

        return $this->to($this->user->email)->view('email.custom-email-verfication')
            ->subject('Verify Your Email Address')
            ->with([
                'user' => $this->user,
                'verificationUrl' => $this->verificationUrl,
                'viewInBrowserUrl' => $viewInBrowserUrl,
            ]);
    }
}
