<div class="d-flex justify-content-end gap-2">
    <a href="{!! route('dashboard.pages.edit', $page->id) !!}" class="action-icon-btn action-edit" title="{!! __('general.edit') !!}">
        <i class="icon-pencil"></i>
    </a>

    <button type="button" class="action-icon-btn action-delete js-delete-btn"
        data-url="{!! route('dashboard.pages.destroy') !!}" data-id="{!! $page->id !!}" title="{!! __('general.delete') !!}">
        <i class="ti-trash"></i>
    </button>
</div>
