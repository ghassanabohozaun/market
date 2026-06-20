<div class="d-flex justify-content-end gap-2">
    <a href="<?php echo e(route('dashboard.roles.edit', $role->id)); ?>" class="action-icon-btn action-edit" title="<?php echo __('general.edit'); ?>">
        <i class="icon-pencil"></i>
    </a>
    <button type="button" class="action-icon-btn action-delete delete-confirm"
        data-id="<?php echo $role->id; ?>" data-route="<?php echo route('dashboard.roles.destroy'); ?>" data-title="<?php echo __('general.ask_delete_record'); ?>"
        data-text="<?php echo __('general.delete_warning_text'); ?>" title="<?php echo __('general.delete'); ?>">
        <i class="ti-trash"></i>
    </button>
</div>
<?php /**PATH C:\laragon\www\market\resources\views/dashboard/roles/parts/action.blade.php ENDPATH**/ ?>