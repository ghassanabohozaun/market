<!DOCTYPE html>
<html lang="<?php echo e(Lang()); ?>" dir="<?php echo e(Lang() == 'ar' ? 'rtl' : 'ltr'); ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo __('dashboard.dashboard'); ?> | <?php echo $__env->yieldContent('title'); ?> </title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Preload Fonts -->
    <link rel="preload" href="<?php echo asset('assets/fonts/tajawal/tajawal-v12-arabic_latin-regular.woff2'); ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo asset('assets/fonts/tajawal/tajawal-v12-arabic_latin-700.woff2'); ?>" as="font" type="font/woff2" crossorigin>

    <!-- Preload Icons -->
    <link rel="preload" href="<?php echo asset('assets/dashboard/vendors/mdi/fonts/materialdesignicons-webfont.woff2?v=7.4.47'); ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo asset('assets/dashboard/vendors/font-awesome/fonts/fontawesome-webfont.woff2?v=4.7.0'); ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo asset('assets/dashboard/vendors/ti-icons/fonts/themify.woff'); ?>" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="<?php echo asset('assets/dashboard/vendors/simple-line-icons/fonts/Simple-Line-Icons.woff2?v=2.4.0'); ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo asset('assets/dashboard/vendors/feather/fonts/feather-webfont.woff'); ?>" as="font" type="font/woff" crossorigin>

    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/feather/feather.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/mdi/css/materialdesignicons.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/typicons/typicons.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/simple-line-icons/css/simple-line-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/css/vendor.bundle.base.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/flatpickr/flatpickr.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/flag-icon-css/css/flag-icons.min.css'); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Lang() == 'ar'): ?>
        <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/bootstrap-rtl/bootstrap.rtl.min.css'); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('assets/dashboard/js/select.dataTables.min.css'); ?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/css/style.css'); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Lang() == 'ar'): ?>
        <link rel="stylesheet" href="<?php echo asset('assets/dashboard/css/rtl-overrides.css'); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Lang() == 'ar'): ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/css/tajawal.css'); ?>">
    <!-- endinject -->
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/vendors/sweetalert2/sweetalert2.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/css/mystyle.css'); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo asset('vendor/flasher/flasher.min.css'); ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo setting()->favicon ? asset('uploads/settings/' . setting()->favicon) : asset('assets/dashboard/images/dokkana-logo.png'); ?>" />
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body class="with-welcome-text <?php echo e(Lang() == 'ar' ? 'rtl' : ''); ?>">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php echo $__env->make('layouts.dashboard.app-parts._navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php echo $__env->make('layouts.dashboard.app-parts._sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- partial -->
            <div class="main-panel">

                <?php echo $__env->yieldContent('content'); ?>

                <!-- partial:partials/_footer.html -->
                <?php echo $__env->make('layouts.dashboard.app-parts._footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo asset('assets/dashboard/vendors/js/vendor.bundle.base.js'); ?>"></script>
    <script src="<?php echo asset('assets/dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?php echo asset('assets/dashboard/vendors/chart.js/chart.umd.js'); ?>"></script>
    <script src="<?php echo asset('assets/dashboard/vendors/progressbar.js/progressbar.min.js'); ?>"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo asset('assets/dashboard/js/off-canvas.js'); ?>"></script>
    <script src="<?php echo asset('assets/dashboard/js/template.js'); ?>"></script>
    <script src="<?php echo asset('assets/dashboard/js/hoverable-collapse.js'); ?>"></script>
    <script src="<?php echo asset('assets/dashboard/js/todolist.js'); ?>"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?php echo asset('assets/dashboard/js/jquery.cookie.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/dashboard/js/dashboard.js'); ?>"></script>

    <script src="<?php echo asset('assets/dashboard/vendors/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
    <script src="<?php echo asset('assets/dashboard/vendors/flatpickr/flatpickr.js'); ?>"></script>
    <script src="<?php echo asset('assets/dashboard/vendors/flatpickr/flatpickr-ar.js'); ?>"></script>
    <script src="<?php echo asset('vendor/flasher/flasher.min.js'); ?>" type="text/javascript"></script>

    <script>
        window.Translations = {
            select_from_list: "<?php echo __('general.select_from_list'); ?>",
            ask_delete_record: "<?php echo __('general.ask_delete_record'); ?>",
            routes: {
                logout: "<?php echo e(route('dashboard.logout')); ?>",
                lock_screen: "<?php echo e(route('dashboard.lock.screen')); ?>",
                unlock_screen: "<?php echo e(route('dashboard.unlock.screen')); ?>",
                dashboard_index: "<?php echo e(route('dashboard.index')); ?>"
            },
            labels: {
                confirm: "<?php echo e(__('general.confirm')); ?>",
                cancel: "<?php echo e(__('general.cancel')); ?>",
                unlock: "<?php echo e(__('auth.unlock')); ?>",
                enabled: "<?php echo e(__('general.enable')); ?>",
                disabled: "<?php echo e(__('general.disabled')); ?>",
                active: "<?php echo e(__('general.active')); ?>",
                inactive: "<?php echo e(__('general.inactive')); ?>"
            },
            messages: {
                delete_confirmation: "<?php echo e(__('general.delete_confirmation')); ?>",
                delete_warning: "<?php echo e(__('general.delete_warning')); ?>",
                error: "<?php echo e(__('general.error')); ?>",
                success: "<?php echo e(__('general.success')); ?>",
                warning: "<?php echo e(__('general.warning')); ?>",
                info: "<?php echo e(__('general.info')); ?>",
                failed: "<?php echo e(__('auth.failed')); ?>",
                status_updated: "<?php echo e(__('general.change_status_success_message')); ?>",
                status_failed: "<?php echo e(__('general.change_status_error_message')); ?>"
            },
            delete_warning_text: "<?php echo __('general.delete_warning_text'); ?>",
            yes_delete_it: "<?php echo __('general.yes_delete_it'); ?>",
            no_cancel: "<?php echo __('general.no_cancel'); ?>",
            deleted: "<?php echo __('general.deleted'); ?>",
            delete_success_message: "<?php echo __('general.delete_success_message'); ?>",
            error: "<?php echo __('general.error'); ?>",
            delete_error_message: "<?php echo __('general.delete_error_message'); ?>",
            choose_file: "<?php echo __('general.choose_file'); ?>",
            no_file_chosen: "<?php echo __('general.no_file_chosen'); ?>",
            details: "<?php echo __('general.details'); ?>",
            ok: "<?php echo __('general.ok_got_it'); ?>",
            ask_discard_changes: "<?php echo __('general.ask_discard_changes'); ?>",
            discard_warning_text: "<?php echo __('general.discard_warning_text'); ?>",
            yes_discard: "<?php echo __('general.yes_discard'); ?>"
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

    <script src="<?php echo asset('assets/dashboard/js/myscripts.js'); ?>"></script>
    <script src="<?php echo e(asset('assets/dashboard/js/fileinput.js?v=1.0.1')); ?>"></script>
    <script src="<?php echo asset('assets/dashboard/js/hud-hub.js'); ?>"></script>
    <script src="<?php echo asset('assets/dashboard/js/lock-screen.js'); ?>"></script>
    <?php echo $__env->yieldPushContent('modals'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\market\resources\views/layouts/dashboard/app.blade.php ENDPATH**/ ?>