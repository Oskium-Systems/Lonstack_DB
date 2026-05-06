<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user_subject }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f7fa;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            text-align: center;
        }
        .logo {
            color: #ffffff;
            font-size: 32px;
            font-weight: bold;
            margin: 0;
            letter-spacing: 1px;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            color: #666666;
            font-size: 16px;
            margin-bottom: 30px;
        }
        .otp-container {
            background-color: #f8f9fa;
            border: 2px dashed #667eea;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-label {
            font-size: 14px;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        .otp-code {
            font-size: 42px;
            font-weight: bold;
            color: #667eea;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
            margin: 10px 0;
        }
        .otp-validity {
            font-size: 13px;
            color: #999999;
            margin-top: 15px;
        }
        .info-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer-text {
            color: #999999;
            font-size: 13px;
            margin: 5px 0;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }
        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 30px 0;
        }
        @media only screen and (max-width: 600px) {
            .content {
                padding: 30px 20px;
            }
            .otp-code {
                font-size: 36px;
                letter-spacing: 6px;
            }
            .greeting {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1 class="logo">FinWise</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <h2 class="greeting">Hello, {{ $user->name ?? 'Valued User' }}!</h2>

            <p class="message">
                {{ $email_content }}
            </p>

            <!-- OTP Box -->
            <div class="otp-container">
                <div class="otp-label">Your Verification Code</div>
                <div class="otp-code">{{ $otp_code }}</div>
                <div class="otp-validity">This code will expire in 10 minutes</div>
            </div>

            <!-- Security Notice -->
            <div class="info-box">
                <p>
                    <strong>Security Notice:</strong> Never share this code with anyone. FinWise will never ask for your verification code via phone or email.
                </p>
            </div>

            <div class="divider"></div>

            <p class="message" style="font-size: 14px;">
                If you didn't request this verification code, please ignore this email or contact our support team if you have concerns about your account security.
            </p>

            <p class="message" style="font-size: 14px; margin-top: 20px;">
                Best regards,<br>
                <strong>The FinWise Team</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-text"><strong>FinWise</strong></p>
            <p class="footer-text">Your trusted financial companion</p>

            <div class="social-links">
                <a href="#">Help Center</a> |
                <a href="#">Privacy Policy</a> |
                <a href="#">Contact Us</a>
            </div>

            <p class="footer-text">
                © {{ date('Y') }} FinWise. All rights reserved.
            </p>

            <p class="footer-text" style="margin-top: 15px; font-size: 11px;">
                This email was sent to {{ $user->email }}
            </p>
        </div>
    </div>
</body>
</html>
