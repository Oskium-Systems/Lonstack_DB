<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Brevo key: ' . config('services.brevo.api_key'));

        $validated = $request->validate([
            'name'                 => ['required', 'string', 'max:255'],
            'email'                => ['required', 'email', 'max:255'],
            'phone'                => ['nullable', 'string', 'max:20'],
            'subject'              => ['nullable', 'string', 'max:255'],
            'service'              => ['nullable', 'string', 'max:255'],
            'message'              => ['required', 'string', 'min:10', 'max:5000'],
            'g-recaptcha-response' => ['required'],
        ], [
            'name.required'                => 'Please provide your name.',
            'email.required'               => 'Please provide your email address.',
            'email.email'                  => 'Please provide a valid email address.',
            'message.required'             => 'Please write your message.',
            'message.min'                  => 'Your message must be at least 10 characters.',
            'message.max'                  => 'Your message cannot exceed 5000 characters.',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification.',
        ]);

        // Verify reCAPTCHA with Google
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (! $recaptcha->json('success')) {
            return response()->json([
                'success' => false,
                'message' => 'reCAPTCHA verification failed. Please try again.',
            ], 422);
        }

        try {
            DB::beginTransaction();

            $inquiry = ContactInquiry::create([
                'name'    => $validated['name'],
                'email'   => $validated['email'],
                'phone'   => $validated['phone'] ?? null,
                'subject' => $validated['subject'] ?? null,
                'service' => $validated['service'] ?? null,
                'message' => $validated['message'],
            ]);

            // Render email view
            $emailBody = view('emails.contact_inquiry', ['inquiry' => $inquiry])->render();

            // Send via Brevo HTTP API
            $response = Http::withHeaders([
                'api-key' => config('services.brevo.api_key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.brevo.com/v3/smtp/email', [
                'sender'      => [
                    'name'  => 'Lonstack',
                    'email' => 'info@lonstack.com',
                ],
                'to'          => [
                    ['email' => 'info@lonstack.com', 'name' => 'Lonstack'],
                    // ['email' => 'alexcyril34@gmail.com', 'name' => 'Alex'],
                ],
                'replyTo'     => [
                    'email' => $inquiry->email,
                    'name'  => $inquiry->name,
                ],
                'subject'     => 'New Contact Inquiry: ' . ($inquiry->subject ?? $inquiry->name),
                'htmlContent' => $emailBody,
            ]);

            Log::info('Brevo response status: ' . $response->status());
            Log::info('Brevo response body: ' . $response->body());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent! We will get back to you shortly.',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Contact form submission failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }
}
