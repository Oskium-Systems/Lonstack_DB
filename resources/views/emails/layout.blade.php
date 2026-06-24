<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'BIGHIT MUSIC')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            display: block;
        }

        @import url('https://fonts.googleapis.com/css2?family=Teko:wght@400;500&family=Barlow+Condensed:wght@400;600&display=swap');

        body {
            background-color: #f5f5f5;
            font-family: 'Barlow Condensed', Arial, sans-serif;
            color: #101010;
            line-height: 1.6;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f5f5f5;
            padding: 2.5rem 1rem;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .email-header {
            background-color: #101010;
            padding: 2rem 2rem 1.2rem;
            text-align: center;
        }

        .email-header img {
            height: 40px;
            width: auto;
            display: inline-block;
        }

        .email-hero {
            background-color: #101010;
            padding: 0 2.5rem 0.3rem;
            text-align: center;
            border-bottom: 2px solid #101010;
        }

        .email-hero__title {
            font-family: 'Teko', Arial, sans-serif;
            font-size: 1rem;
            font-weight: 500;
            letter-spacing: 0.01em;
            text-transform: uppercase;
            color: #ffffff;
        }

        .email-content {
            padding: 2.5rem;
            background-color: #ffffff;
        }

        .email-content p {
            font-family: 'Barlow Condensed', Arial, sans-serif;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.65;
            color: #101010;
            margin-bottom: 1.25rem;
        }

        .email-content p:last-child {
            margin-bottom: 0;
        }

        .email-content strong,
        .email-content b {
            font-weight: 600;
            color: #101010;
        }

        .email-content a {
            color: #101010;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .email-content h2,
        .email-content h3 {
            font-family: 'Teko', Arial, sans-serif;
            font-weight: 500;
            text-transform: uppercase;
            color: #101010;
            line-height: 1;
            margin-bottom: 0.75rem;
            margin-top: 1.5rem;
        }

        .email-content h2 {
            font-size: 1.75rem;
        }

        .email-content h3 {
            font-size: 1.375rem;
        }

        .email-content ul,
        .email-content ol {
            padding-left: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .email-content li {
            margin-bottom: 0.375rem;
            font-size: 1rem;
            line-height: 1.6;
            color: #101010;
        }

        /* ── OTP block ── */
        .email-otp {
            margin: 2rem 0;
            text-align: center;
        }

        .email-otp__code {
            display: inline-block;
            font-family: 'Teko', monospace, Arial, sans-serif;
            font-size: 3.5rem;
            font-weight: 500;
            letter-spacing: 0.5rem;
            color: #101010;
            background-color: #f5f5f5;
            padding: 1rem 2.5rem;
            border: 2px solid #101010;
        }

        .email-otp__label {
            font-family: 'Barlow Condensed', Arial, sans-serif;
            font-size: 0.875rem;
            color: #757575;
            margin-top: 0.625rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ── Divider ── */
        .email-divider {
            height: 1px;
            background-color: #eeeeee;
            margin: 1.5rem 0;
        }

        /* ── Button ── */
        .email-btn {
            display: inline-block;
            margin: 1.5rem 0;
            padding: 0.875rem 2.5rem;
            background-color: #101010;
            color: #ffffff !important;
            font-family: 'Teko', Arial, sans-serif;
            font-size: 1.25rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-decoration: none !important;
        }

        /* ── Info rows ── */
        .email-info {
            background-color: #f5f5f5;
            padding: 0;
            margin: 1.25rem 0;
            border-collapse: collapse;
            width: 100%;
        }

        .email-info__row td {
            padding: 0.625rem 1.25rem;
            border-bottom: 1px solid #eeeeee;
            font-size: 1rem;
            vertical-align: top;
            line-height: 1.5;
        }

        .email-info__row:last-child td {
            border-bottom: none;
        }

        .email-info__label {
            font-weight: 600;
            color: #757575;
            text-transform: uppercase;
            font-size: 0.8125rem;
            letter-spacing: 0.04em;
            white-space: nowrap;
            width: 140px;
            min-width: 140px;
        }

        .email-info__value {
            color: #101010;
            font-weight: 400;
        }

        /* ── Notice ── */
        .email-notice {
            background-color: #fafafa;
            border-left: 3px solid #101010;
            padding: 1rem 1.25rem;
            margin: 1.25rem 0;
            font-size: 0.9375rem;
            color: #757575;
            line-height: 1.6;
            font-family: 'Barlow Condensed', Arial, sans-serif;
        }

        /* ── Status badge ── */
        .email-badge {
            display: inline-block;
            padding: 0.25rem 0.875rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background-color: #101010;
            color: #ffffff;
        }

        .email-badge--pending {
            background-color: #d97706;
        }

        .email-badge--approved {
            background-color: #059669;
        }

        .email-badge--rejected {
            background-color: #dc2626;
        }

        /* ── Footer ── */
        .email-footer {
            background-color: #101010;
            padding: 1.5rem 2.5rem;
            text-align: center;
        }

        .email-footer__text {
            font-family: 'Barlow Condensed', Arial, sans-serif;
            font-size: 0.875rem;
            color: #757575;
            line-height: 1.6;
            margin-bottom: 0.375rem;
        }

        .email-footer__text a {
            color: #757575;
            text-decoration: underline;
        }

        .email-footer__copy {
            font-family: 'Barlow Condensed', Arial, sans-serif;
            font-size: 0.8125rem;
            color: #424242;
            margin-top: 0.75rem;
        }

        /* ── Mobile ── */
        @media (max-width: 600px) {
            .email-wrapper {
                padding: 1rem 0;
            }

            .email-header {
                padding: 1.5rem;
            }

            .email-hero {
                padding: 0 1.5rem 1rem;
            }

            .email-content {
                padding: 1.5rem;
            }

            .email-footer {
                padding: 1.25rem 1.5rem;
            }

            .email-hero__title {
                font-size: 1.25rem;
            }

            .email-otp__code {
                font-size: 2.5rem;
                letter-spacing: 0.3rem;
                padding: 0.875rem 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">

            {{-- Logo --}}
            <div class="email-header">
                <img src="https://res.cloudinary.com/dpfcntrwo/image/upload/v1780301681/bhm-logo-white_hdeurs.svg"
                    alt="BIGHIT MUSIC" height="40">
            </div>

            {{-- Title band --}}
            <div class="email-hero">
                <h1 class="email-hero__title">@yield('title', 'BIGHIT MUSIC')</h1>
            </div>

            {{-- Body --}}
            <div class="email-content">
                @yield('content')
            </div>

            {{-- Footer --}}
            <div class="email-footer">
                <p class="email-footer__text">
                    This email was sent by BIGHIT MUSIC.
                </p>
                <p class="email-footer__text">
                    <a href="https://ibighit.com/privacy">Privacy Policy</a>
                    &nbsp;&middot;&nbsp;
                    <a href="https://ibighit.com/cookie">Cookie Policy</a>
                </p>
                <p class="email-footer__copy">
                    &copy; {{ date('Y') }} BigHit Music / HYBE. All rights reserved.
                </p>
            </div>

        </div>
    </div>
</body>

</html>
