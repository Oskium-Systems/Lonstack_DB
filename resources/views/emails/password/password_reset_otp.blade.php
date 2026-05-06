<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: #212b36;
            padding: 30px 15px;
            text-align: center;
            color: #ffffff;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .email-body {
            padding: 30px 15px;
            color: #333333;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #555555;
        }
        .otp-container {
            background-color: #f8f9fa;
            border: 2px dashed #212b36;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-label {
            font-size: 14px;
            color: #666666;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .otp-code {
            font-size: 28px;
            font-weight: bold;
            color: #212b36;
            letter-spacing: 8px;
            margin: 10px 0;
        }
        .otp-validity {
            font-size: 14px;
            color: #dc3545;
            margin-top: 15px;
        }
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning p {
            margin: 0;
            font-size: 14px;
            color: #856404;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #666666;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 5px 0;
        }
        .company-name {
            font-weight: bold;
            color: #212b36;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🔐 Password Reset Request</h1>
        </div>

        <div class="email-body">
            <p class="greeting">Hello {{ $user->name }},</p>

            <p class="message">
                We received a request to reset your password for your <span class="company-name">{{ $companyName }}</span> account.
                Use the OTP code below to complete the password reset process.
            </p>

            <div class="otp-container">
                <div class="otp-label">Your OTP Code</div>
                <div class="otp-code">{{ $otp }}</div>
                <div class="otp-validity">⏰ Valid for 10 minutes</div>
            </div>

            <div class="warning">
                <p>
                    <strong>⚠️ Security Alert:</strong> If you didn't request this password reset,
                    please ignore this email and ensure your account is secure. Your password will remain unchanged.
                </p>
            </div>

            <p class="message">
                For security reasons, never share this OTP code with anyone. Our team will never ask you
                for this code via phone, email, or any other means.
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} <span class="company-name">{{ $companyName }}</span>. All rights reserved.</p>
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
