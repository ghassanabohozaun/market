<div class="d-flex justify-content-end gap-2">
    <a href="#" class="action-icon-btn action-edit edit_country_button" title="{!! __('general.edit') !!}"
        data-id="{!! $country->id !!}" data-name-ar="{!! $country->getTranslation('name', 'ar') !!}" data-name-en="{!! $country->getTranslation('name', 'en') !!}"
        data-phone-code="{!! $country->phone_code !!}" data-flag-code="{!! $country->flag_code !!}"
        data-status-active="{!! $country->status !!}">
        <i class="icon-pencil"></i>
    </a>

    <button type="button" class="action-icon-btn action-delete js-delete-btn" data-id="{!! $country->id !!}"
        data-url="{!! route('dashboard.addresses.countries.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}" data-text="{!! __('general.delete_warning_text') !!}"
        data-confirm-btn="{!! __('general.yes') !!}" data-cancel-btn="{!! __('general.no') !!}"
        data-success-title="{!! __('general.deleted') !!}" data-success-text="{!! __('general.delete_success_message') !!}"
        title="{!! __('general.delete') !!}">
        <i class="ti-trash"></i>
    </button>
</div>
