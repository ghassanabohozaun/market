<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('errors.500_title') }}</title>

    <!-- Local Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/fonts.css') }}">

    <!-- Custom 500 Styles -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/500.css') }}">
    <link rel="shortcut icon" href="{!! setting()->favicon
        ? asset('uploads/settings/' . setting()->favicon)
        : asset('assets/website/images/logo-mini.png') !!}" />
</head>

<body>

    <div class="repair-stage">
        <canvas id="repairCanvas"></canvas>

        <div class="system-card" id="tiltCard">
            <div class="status-indicator">
                <span class="blink-dot"></span> SYSTEM ERROR LOGGED
            </div>

            <h1 class="error-code-500">500</h1>

            <h2 class="title-pro">{{ __('errors.system_disturbance') }}</h2>
            <p class="desc-pro">
                {{ __('errors.engine_obstacle') }}
            </p>

            <div class="btn-group-pro">
                <a href="javascript:location.reload()" class="btn-refresh">
                    <i class="bi bi-arrow-clockwise"></i> {{ __('errors.update_track') }}
                </a>
                <a href="{{ route('website.index') }}" class="btn-support">
                    {{ __('errors.technical_support') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Local Scripts -->
    <script src="{{ asset('assets/website/js/500.js') }}"></script>
</body>

</html>
