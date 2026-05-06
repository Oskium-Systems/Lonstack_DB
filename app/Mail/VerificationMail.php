<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $email_subject;
    public string $email_content;
    public string $otp;


    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $email_subject, string $email_content, string $otp)
    {
        $this->user = $user;
        $this->email_subject = $email_subject;
        $this->email_content = $email_content;
        $this->otp = $otp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->email_subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.email_verification',
            with: [
                'user' => $this->user,
                'user_subject' => $this->email_subject,
                'email_content' => $this->email_content,
                'otp_code' => $this->otp,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
