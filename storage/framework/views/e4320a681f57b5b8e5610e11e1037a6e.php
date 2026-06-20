<!DOCTYPE html>
<html lang="<?php echo e(Lang()); ?>" dir="<?php echo e(Lang() == 'ar' ? 'rtl' : 'ltr'); ?>">

<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <meta charset="utf-8">
    <title> <?php echo __('dashboard.dashboard'); ?> | <?php echo $__env->yieldContent('title'); ?> </title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/vendors/feather/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/vendors/mdi/css/materialdesignicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/vendors/ti-icons/css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/vendors/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/vendors/typicons/typicons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/vendors/simple-line-icons/css/simple-line-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/vendors/css/vendor.bundle.base.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/css/inter.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo e(asset('assets/dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/css/tajawal.css')); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/css/mystyle.css'); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/css/auth-premium.css')); ?>">

    <link rel="stylesheet" href="<?php echo asset('vendor/flasher/flasher.min.css'); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo setting()->favicon
        ? asset('uploads/settings/' . setting()->favicon)
        : asset('assets/dashboard/images/dokkana-logo.png'); ?>" />
</head>

<body class="<?php echo e(Lang() == 'ar' ? 'rtl' : ''); ?>">


    <?php echo $__env->yieldContent('content'); ?>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo e(asset('assets/dashboard/vendors/js/vendor.bundle.base.js')); ?>"></script>
    
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?php echo e(asset('assets/dashboard/js/off-canvas.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/dashboard/js/template.js')); ?>"></script>
    
    
    
    
    <!-- endinject -->

    <script src="<?php echo asset('vendor/flasher/flasher.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/dashboard/js/myscripts.js'); ?>"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\market\resources\views/layouts/dashboard/auth.blade.php ENDPATH**/ ?>