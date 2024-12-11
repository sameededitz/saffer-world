<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomPasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $resetUrl;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $resetUrl
     * @return void
     */
    public function __construct($user, $resetUrl,$token)
    {
        $this->user = $user;
        $this->resetUrl = $resetUrl;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewInBrowserUrl = route('password.reset.view', [
            'email' => $this->user->email,
            'token' => $this->token,
        ]);

        return $this->to($this->user->email)
            ->view('email.custom-password-reset')
            ->subject('Reset Your Password')
            ->with([
                'user' => $this->user,
                'resetUrl' => $this->resetUrl,
                'viewInBrowserUrl' => $viewInBrowserUrl,
            ]);
    }
}
