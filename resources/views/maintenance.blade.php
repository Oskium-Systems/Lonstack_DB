@php $settings = \App\Models\Setting::current(); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        /* 🔥 Fullscreen Background Image */
        .bg-image {
            position: absolute;
            inset: 0;
            background: url("{{ asset('image/maitenance.jpg') }}") center/cover no-repeat;
            z-index: -2;
        }

        /* 🔥 Dark Overlay */
        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: -1;
        }

        /* 🔥 Header */
        .header {
            position: absolute;
            top: 0;
            width: 100%;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* 🔥 Center Content */
        .content {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .title {
            font-size: clamp(28px, 5vw, 48px);
            font-weight: 700;
            margin-bottom: 15px;
        }

        .subtitle {
            font-size: 16px;
            max-width: 500px;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.6;
        }

        /* 🔥 Footer */
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body>

    <div class="bg-image"></div>
    <div class="overlay"></div>

    <!-- Header -->
    <div class="header">
        <div class="logo">
            {{ $settings->company_name ?? config('app.name') }}
        </div>
    </div>

    <!-- Center Content -->
    <div class="content">
        {{-- <h1 class="title">We’ll be back soon</h1>

        <p class="subtitle">
            We are currently performing scheduled maintenance. We will be back shortly.
        </p> --}}
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; {{ date('Y') }} {{ $settings->company_name ?? config('app.name') }}. All rights reserved.
    </div>

</body>
</html>
