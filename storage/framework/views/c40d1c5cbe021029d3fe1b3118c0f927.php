<?php $__env->startSection('title', __('website.home')); ?>

<?php $__env->startSection('content'); ?>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 dark:bg-[#0b1121]">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(optional(setting())->logo): ?>
            <img src="<?php echo e(asset('uploads/settings/' . optional(setting())->logo)); ?>" alt="Logo" class="h-24 w-auto rounded shadow-sm mb-4">
        <?php else: ?>
            <i class="ph-fill ph-storefront text-6xl text-gray-300 dark:text-gray-700 mb-4"></i>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <h1 class="text-3xl font-bold text-gray-400 dark:text-gray-600">
            <?php echo e(optional(setting())->getTranslation('site_name', app()->getLocale()) ?: __('website.home')); ?>

        </h1>
        <p class="text-gray-500 mt-2"><?php echo e(__('website.coming_soon')); ?></p>
        
        <a href="<?php echo e(route('website.market')); ?>" class="mt-8 bg-primary text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-emerald-500/30 hover:bg-emerald-600 transition-colors">
            <?php echo e(__('website.go_to_market')); ?>

        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.website.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\market\resources\views/website/index.blade.php ENDPATH**/ ?>