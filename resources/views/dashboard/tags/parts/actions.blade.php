<div class="d-flex align-items-center justify-content-end gap-2">
    <button type="button" class="action-icon-btn action-edit custom-edit-btn"
        data-bs-toggle="modal" data-bs-target="#edittagModal" data-id="{{ $tag->id }}"
        data-name-ar="{{ $tag->getTranslation('name', 'ar') }}"
        data-name-en="{{ $tag->getTranslation('name', 'en') }}"
        data-status="{{ $tag->status }}"
        title="{{ __('general.edit') }}">
        <i class="icon-pencil"></i>
    </button>
    
    <button type="button" class="action-icon-btn action-delete js-delete-btn"
        data-id="{!! $tag->id !!}" data-url="{!! route('dashboard.tags.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
        data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
        data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
        data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
        <i class="ti-trash"></i>
    </button>
</div>
