<div class="d-flex justify-content-end gap-2">
    <a href="javascript:void(0)" class="action-icon-btn action-edit edit_governorate_button"
        title="{!! __('general.edit') !!}" 
        governorate-id="{!! $governorate->id !!}" 
        governorate-name-ar="{!! $governorate->getTranslation('name', 'ar') !!}"
        governorate-name-en="{!! $governorate->getTranslation('name', 'en') !!}" 
        country-id="{!! $governorate->country_id !!}" 
        country-flag="{!! $governorate->country->flag_code !!}">
        <i class="icon-pencil"></i>
    </a>

    <button type="button" class="action-icon-btn action-delete delete-confirm"
        data-id="{!! $governorate->id !!}" data-route="{!! route('dashboard.addresses.governorates.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
        data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
        data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
        data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
        <i class="ti-trash"></i>
    </button>
</div>
