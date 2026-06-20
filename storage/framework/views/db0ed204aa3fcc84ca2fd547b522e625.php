<!DOCTYPE html>
<html lang="<?php echo e(Lang()); ?>" dir="<?php echo e(Lang() == 'ar' ? 'rtl' : 'ltr'); ?>" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $__env->yieldContent('title', 'دفتر البقالة'); ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Tajawal', 'sans-serif'],
                    },
                    colors: {
                        primary: '#10b981', // emerald-500
                        secondary: '#3b82f6', // blue-500
                        dark: '#0f172a', // slate-900
                        darkCard: '#1e293b', // slate-800
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/website/style.css')); ?>">
    <link rel="shortcut icon" href="<?php echo setting()->favicon ? asset('uploads/settings/' . setting()->favicon) : asset('assets/dashboard/images/dokkana-logo.png'); ?>" />
    <?php echo $__env->yieldPushContent('css'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="bg-gray-50 text-gray-800 dark:bg-dark dark:text-gray-100 transition-colors duration-300 antialiased">
    
    <?php echo $__env->yieldContent('content'); ?>

    <!-- Scripts -->
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\market\resources\views/layouts/website/app.blade.php ENDPATH**/ ?>