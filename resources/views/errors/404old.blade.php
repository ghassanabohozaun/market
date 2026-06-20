<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('dashboard.site_name') }} | {{ __('dashboard.page_not_found') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/tajawal.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/dashboard/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
                <div class="row flex-grow">
                    <div class="col-lg-7 mx-auto text-white">
                        <div class="row align-items-center d-flex flex-row">
                            <div class="col-lg-6 text-lg-right pr-lg-4">
                                <h1 class="display-1 mb-0">404</h1>
                            </div>
                            <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                                <h2>{{ __('dashboard.sorry') }}</h2>
                                <h3 class="fw-light">{{ __('dashboard.page_not_found') }}</h3>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12 text-center mt-xl-2">
                                <a class="text-white fw-medium"
                                    href="{{ route('dashboard.index') }}">{{ __('dashboard.back_to_home') }}</a>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12 mt-xl-2">
                                <p class="text-white fw-medium text-center">{{ __('dashboard.copyright') }} &copy;
                                    {{ date('Y') }} {{ __('dashboard.all_rights_reserved') }}.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/dashboard/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/template.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/settings.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/todolist.js') }}"></script>
    <!-- endinject -->

    <script src="{{ asset('assets/dashboard/js/rtl-toggle.js') }}"></script>
</body>

</html>
