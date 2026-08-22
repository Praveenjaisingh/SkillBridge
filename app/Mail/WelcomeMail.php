<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user)
    {
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this
            ->subject('Welcome to SkillBridge, ' . $this->user->name . '! 🎉')
            ->view('emails.welcome')
            ->with([
                'user' => $this->user,
                'loginUrl' => route('login'),
                'dashboardUrl' => route('dashboard'),
            ]);
    }
}
