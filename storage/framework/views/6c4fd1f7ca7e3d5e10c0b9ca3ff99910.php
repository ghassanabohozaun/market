<div class="d-flex justify-content-end gap-2">
    <a href="#" class="action-icon-btn action-edit edit_country_button" title="<?php echo __('general.edit'); ?>"
        data-id="<?php echo $country->id; ?>" data-name-ar="<?php echo $country->getTranslation('name', 'ar'); ?>" data-name-en="<?php echo $country->getTranslation('name', 'en'); ?>"
        data-phone-code="<?php echo $country->phone_code; ?>" data-flag-code="<?php echo $country->flag_code; ?>"
        data-status-active="<?php echo $country->status; ?>">
        <i class="icon-pencil"></i>
    </a>

    <button type="button" class="action-icon-btn action-delete js-delete-btn" data-id="<?php echo $country->id; ?>"
        data-url="<?php echo route('dashboard.addresses.countries.destroy'); ?>" data-title="<?php echo __('general.ask_delete_record'); ?>" data-text="<?php echo __('general.delete_warning_text'); ?>"
        data-confirm-btn="<?php echo __('general.yes'); ?>" data-cancel-btn="<?php echo __('general.no'); ?>"
        data-success-title="<?php echo __('general.deleted'); ?>" data-success-text="<?php echo __('general.delete_success_message'); ?>"
        title="<?php echo __('general.delete'); ?>">
        <i class="ti-trash"></i>
    </button>
</div>
<?php /**PATH C:\laragon\www\market\resources\views/dashboard/addresses/countries/parts/actions.blade.php ENDPATH**/ ?>