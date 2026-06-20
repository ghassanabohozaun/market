<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('errors.403_title') }}</title>

    <!-- Local Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/fonts.css') }}">

    <!-- Custom 403 Styles -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/403.css') }}">
</head>

<body>

    <div class="constellation-stage">
        <canvas id="constellationCanvas"></canvas>

        <div class="admin-vault" id="tiltCard">
            <div class="admin-badge">
                <i class="bi bi-shield-lock-fill me-2"></i> {{ __('errors.restricted_zone') }}
            </div>

            <h1 class="forbidden-code">403</h1>

            <h2 class="title-pro">{{ __('errors.access_limited') }}</h2>
            <p class="desc-pro">
                {{ __('errors.super_admin_message') }}
            </p>

            <a href="{{ route('dashboard.index') }}" class="btn-neqat-admin">
                <i class="bi bi-speedometer2"></i> {{ __('errors.back_to_dashboard') }}
            </a>
        </div>
    </div>

    <!-- Local Scripts -->
    <script src="{{ asset('assets/website/js/403.js') }}"></script>
</body>

</html>
