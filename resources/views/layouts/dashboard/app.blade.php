<!DOCTYPE html>
<html lang="{{ Lang() }}" dir="{{ Lang() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{!! __('dashboard.dashboard') !!} | @yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Preload Fonts -->
    <link rel="preload" href="{!! asset('assets/fonts/tajawal/tajawal-v12-arabic_latin-regular.woff2') !!}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{!! asset('assets/fonts/tajawal/tajawal-v12-arabic_latin-700.woff2') !!}" as="font" type="font/woff2" crossorigin>

    <!-- Preload Icons -->
    <link rel="preload" href="{!! asset('assets/dashboard/vendors/mdi/fonts/materialdesignicons-webfont.woff2?v=7.4.47') !!}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{!! asset('assets/dashboard/vendors/font-awesome/fonts/fontawesome-webfont.woff2?v=4.7.0') !!}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{!! asset('assets/dashboard/vendors/ti-icons/fonts/themify.woff') !!}" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="{!! asset('assets/dashboard/vendors/simple-line-icons/fonts/Simple-Line-Icons.woff2?v=2.4.0') !!}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{!! asset('assets/dashboard/vendors/feather/fonts/feather-webfont.woff') !!}" as="font" type="font/woff" crossorigin>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/feather/feather.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/mdi/css/materialdesignicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/ti-icons/css/themify-icons.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/typicons/typicons.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/simple-line-icons/css/simple-line-icons.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/css/vendor.bundle.base.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/flatpickr/flatpickr.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/flag-icon-css/css/flag-icons.min.css') !!}">
    @if (Lang() == 'ar')
        <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/bootstrap-rtl/bootstrap.rtl.min.css') !!}">
    @endif
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashboard/js/select.dataTables.min.css') !!}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{!! asset('assets/dashboard/css/style.css') !!}">
    @if (Lang() == 'ar')
        <link rel="stylesheet" href="{!! asset('assets/dashboard/css/rtl-overrides.css') !!}">
    @endif
    @if (Lang() == 'ar')
    @endif
    <link rel="stylesheet" href="{!! asset('assets/dashboard/css/tajawal.css') !!}">
    <!-- endinject -->
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/sweetalert2/sweetalert2.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/css/mystyle.css') !!}?v={{ time() }}">
    <link rel="stylesheet" href="{!! asset('vendor/flasher/flasher.min.css') !!}" rel="stylesheet">
    <link rel="shortcut icon" href="{!! setting()->favicon ? asset('uploads/settings/' . setting()->favicon) : asset('assets/dashboard/images/dokkana-logo.png') !!}" />
    @stack('css')
</head>

<body class="with-welcome-text {{ Lang() == 'ar' ? 'rtl' : '' }}">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('layouts.dashboard.app-parts._navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('layouts.dashboard.app-parts._sidebar')

            <!-- partial -->
            <div class="main-panel">

                @yield('content')

                <!-- partial:partials/_footer.html -->
                @include('layouts.dashboard.app-parts._footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{!! asset('assets/dashboard/vendors/js/vendor.bundle.base.js') !!}"></script>
    <script src="{!! asset('assets/dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{!! asset('assets/dashboard/vendors/chart.js/chart.umd.js') !!}"></script>
    <script src="{!! asset('assets/dashboard/vendors/progressbar.js/progressbar.min.js') !!}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{!! asset('assets/dashboard/js/off-canvas.js') !!}"></script>
    <script src="{!! asset('assets/dashboard/js/template.js') !!}"></script>
    <script src="{!! asset('assets/dashboard/js/hoverable-collapse.js') !!}"></script>
    <script src="{!! asset('assets/dashboard/js/todolist.js') !!}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{!! asset('assets/dashboard/js/jquery.cookie.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/dashboard/js/dashboard.js') !!}"></script>

    <script src="{!! asset('assets/dashboard/vendors/sweetalert2/sweetalert2.all.min.js') !!}"></script>
    <script src="{!! asset('assets/dashboard/vendors/flatpickr/flatpickr.js') !!}"></script>
    <script src="{!! asset('assets/dashboard/vendors/flatpickr/flatpickr-ar.js') !!}"></script>
    <script src="{!! asset('vendor/flasher/flasher.min.js') !!}" type="text/javascript"></script>

    <script>
        window.Translations = {
            select_from_list: "{!! __('general.select_from_list') !!}",
            ask_delete_record: "{!! __('general.ask_delete_record') !!}",
            routes: {
                logout: "{{ route('dashboard.logout') }}",
                lock_screen: "{{ route('dashboard.lock.screen') }}",
                unlock_screen: "{{ route('dashboard.unlock.screen') }}",
                dashboard_index: "{{ route('dashboard.index') }}"
            },
            labels: {
                confirm: "{{ __('general.confirm') }}",
                cancel: "{{ __('general.cancel') }}",
                unlock: "{{ __('auth.unlock') }}",
                enabled: "{{ __('general.enable') }}",
                disabled: "{{ __('general.disabled') }}",
                active: "{{ __('general.active') }}",
                inactive: "{{ __('general.inactive') }}"
            },
            messages: {
                delete_confirmation: "{{ __('general.delete_confirmation') }}",
                delete_warning: "{{ __('general.delete_warning') }}",
                error: "{{ __('general.error') }}",
                success: "{{ __('general.success') }}",
                warning: "{{ __('general.warning') }}",
                info: "{{ __('general.info') }}",
                failed: "{{ __('auth.failed') }}",
                status_updated: "{{ __('general.change_status_success_message') }}",
                status_failed: "{{ __('general.change_status_error_message') }}"
            },
            delete_warning_text: "{!! __('general.delete_warning_text') !!}",
            yes_delete_it: "{!! __('general.yes_delete_it') !!}",
            no_cancel: "{!! __('general.no_cancel') !!}",
            deleted: "{!! __('general.deleted') !!}",
            delete_success_message: "{!! __('general.delete_success_message') !!}",
            error: "{!! __('general.error') !!}",
            delete_error_message: "{!! __('general.delete_error_message') !!}",
            choose_file: "{!! __('general.choose_file') !!}",
            no_file_chosen: "{!! __('general.no_file_chosen') !!}",
            details: "{!! __('general.details') !!}",
            ok: "{!! __('general.ok_got_it') !!}",
            ask_discard_changes: "{!! __('general.ask_discard_changes') !!}",
            discard_warning_text: "{!! __('general.discard_warning_text') !!}",
            yes_discard: "{!! __('general.yes_discard') !!}"
        };

        // Intercept flasher globally to inject localized titles if missing
        if (typeof flasher !== 'undefined') {
            const originalFlash = flasher.flash;
            flasher.flash = function(type, message, title, options) {
                let resolvedType = type;
                let resolvedMessage = message;
                let resolvedTitle = title;
                let resolvedOptions = options;

                if (typeof resolvedType === 'object') {
                    resolvedOptions = resolvedType;
                    resolvedType = resolvedOptions.type;
                    resolvedMessage = resolvedOptions.message;
                    resolvedTitle = resolvedOptions.title;
                } else if (typeof resolvedMessage === 'object') {
                    resolvedOptions = resolvedMessage;
                    resolvedMessage = resolvedOptions.message;
                    resolvedTitle = resolvedOptions.title;
                } else if (typeof resolvedTitle === 'object') {
                    resolvedOptions = resolvedTitle;
                    resolvedTitle = resolvedOptions.title;
                }

                if (!resolvedTitle) {
                    if (window.Translations && window.Translations.messages) {
                        if (resolvedType === 'success') {
                            resolvedTitle = window.Translations.messages.success || 'Success';
                        } else if (resolvedType === 'error') {
                            resolvedTitle = window.Translations.messages.error || 'Error';
                        } else if (resolvedType === 'warning') {
                            resolvedTitle = window.Translations.messages.warning || 'Warning';
                        } else if (resolvedType === 'info') {
                            resolvedTitle = window.Translations.messages.info || 'Info';
                        }
                    }
                }
                return originalFlash.call(this, resolvedType, resolvedMessage, resolvedTitle, resolvedOptions);
            };
        }
    </script>

    <script src="{!! asset('assets/dashboard/js/myscripts.js') !!}"></script>
    <script src="{{ asset('assets/dashboard/js/fileinput.js?v=1.0.1') }}"></script>
    <script src="{!! asset('assets/dashboard/js/hud-hub.js') !!}"></script>
    <script src="{!! asset('assets/dashboard/js/lock-screen.js') !!}"></script>
    @stack('modals')
    @stack('scripts')
</body>

</html>
