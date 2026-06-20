<div class="d-flex justify-content-end gap-2">
    <a href="javascript:void(0)" class="action-icon-btn action-edit edit_city_button"
        title="{!! __('general.edit') !!}" city-id="{!! $city->id !!}" city-name-ar="{!! $city->getTranslation('name', 'ar') !!}"
        city-name-en="{!! $city->getTranslation('name', 'en') !!}" governorate-id="{!! $city->governorate_id !!}">
        <i class="icon-pencil"></i>
    </a>

    <button type="button" class="action-icon-btn action-delete delete-confirm"
        data-id="{!! $city->id !!}" data-route="{!! route('dashboard.addresses.cities.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
        data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
        data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
        data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
        <i class="ti-trash"></i>
    </button>
</div>
