<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($country->status == 1): ?>
    <span class="badge country_status_<?php echo e($country->id); ?> badge-opacity-success rounded-pill fw-medium px-3 py-1">
        <i class="mdi mdi-check-circle-outline me-1"></i>
        <?php echo __('general.enable'); ?>

    </span>
<?php else: ?>
    <span class="badge country_status_<?php echo e($country->id); ?> badge-opacity-danger rounded-pill fw-medium px-3 py-1">
        <i class="mdi mdi-close-circle-outline me-1"></i>
        <?php echo __('general.disabled'); ?>

    </span>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\laragon\www\market\resources\views/dashboard/addresses/countries/parts/status.blade.php ENDPATH**/ ?>