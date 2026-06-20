
<div class="form-check form-switch d-flex justify-content-center align-items-center m-0 p-0">
    <input type="checkbox" class="form-check-input js-status-change cursor-pointer"
        <?php echo e($country->status == 1 ? 'checked' : ''); ?> data-id="<?php echo e($country->id); ?>"
        data-url="<?php echo e(route('dashboard.addresses.countries.change.status')); ?>" data-badge-prefix="country_status_"
        role="switch" style="width: 2.5rem; height: 1.25rem;">
</div>
<?php /**PATH C:\laragon\www\market\resources\views/dashboard/addresses/countries/parts/manage_status.blade.php ENDPATH**/ ?>