@extends('emails.layout')

@section('title', 'New Contact Inquiry')

@section('content')
    <p>You have received a new contact inquiry from your website.</p>

    <table class="email-info" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr class="email-info__row">
            <td class="email-info__label">Name</td>
            <td class="email-info__value">{{ $inquiry->name }}</td>
        </tr>
        <tr class="email-info__row">
            <td class="email-info__label">Email</td>
            <td class="email-info__value">{{ $inquiry->email }}</td>
        </tr>
        @if($inquiry->phone)
        <tr class="email-info__row">
            <td class="email-info__label">Phone</td>
            <td class="email-info__value">{{ $inquiry->phone }}</td>
        </tr>
        @endif
        @if($inquiry->subject)
        <tr class="email-info__row">
            <td class="email-info__label">Subject</td>
            <td class="email-info__value">{{ $inquiry->subject }}</td>
        </tr>
        @endif
        @if($inquiry->service)
        <tr class="email-info__row">
            <td class="email-info__label">Service</td>
            <td class="email-info__value">{{ $inquiry->service }}</td>
        </tr>
        @endif
        <tr class="email-info__row">
            <td class="email-info__label">Date</td>
            <td class="email-info__value">{{ $inquiry->created_at->format('F j, Y g:i A') }}</td>
        </tr>
    </table>

    <div class="email-divider"></div>

    <p><strong>Message:</strong></p>
    <div class="email-notice">
        {{ $inquiry->message }}
    </div>

    <div class="email-notice">
        Reply directly to this email to respond to {{ $inquiry->name }}.
    </div>
@endsection
