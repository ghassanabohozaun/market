<!DOCTYPE html>
<html lang="{{ Lang() }}" dir="{{ Lang() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <meta charset="utf-8">
    <title> {!! __('dashboard.dashboard') !!} | @yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/inter.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/tajawal.css') }}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/css/mystyle.css') !!}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/auth-premium.css') }}">

    <link rel="stylesheet" href="{!! asset('vendor/flasher/flasher.min.css') !!}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{!! setting()->favicon
        ? asset('uploads/settings/' . setting()->favicon)
        : asset('assets/dashboard/images/dokkana-logo.png') !!}" />
</head>

<body class="{{ Lang() == 'ar' ? 'rtl' : '' }}">


    @yield('content')

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
    {{-- Removed bootstrap-datepicker as it's not needed for auth --}}
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('assets/dashboard/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/template.js') }}"></script>
    {{-- Removed unused JS files for auth screens to optimize memory --}}
    {{-- <script src="{{ asset('assets/dashboard/js/settings.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/dashboard/js/hoverable-collapse.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/dashboard/js/todolist.js') }}"></script> --}}
    <!-- endinject -->

    <script src="{!! asset('vendor/flasher/flasher.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/dashboard/js/myscripts.js') !!}"></script>

    @stack('scripts')
</body>

</html>
