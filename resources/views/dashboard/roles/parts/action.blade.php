<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="action-icon-btn action-edit" title="{!! __('general.edit') !!}">
        <i class="icon-pencil"></i>
    </a>
    <button type="button" class="action-icon-btn action-delete delete-confirm"
        data-id="{!! $role->id !!}" data-route="{!! route('dashboard.roles.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
        data-text="{!! __('general.delete_warning_text') !!}" title="{!! __('general.delete') !!}">
        <i class="ti-trash"></i>
    </button>
</div>
