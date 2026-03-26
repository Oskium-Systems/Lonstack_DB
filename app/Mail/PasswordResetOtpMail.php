<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public User   $user;
    public string $otp;
    public string $companyName;

    public function __construct(
        User   $user,
        string $otp,
        string $companyName = 'FFH Dynamic Concepts'
    ) {
        $this->user        = $user;
        $this->otp         = $otp;
        $this->companyName = $companyName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Password Reset OTP - {$this->companyName}",
        );
    }

    public function content(): Content
    {

        return new Content(
            view: 'emails.password.password_reset_otp',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
