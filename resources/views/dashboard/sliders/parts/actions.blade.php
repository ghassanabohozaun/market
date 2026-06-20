<div class="d-flex justify-content-end gap-2">
    <a href="{!! route('dashboard.sliders.edit', $slider->id) !!}" class="action-icon-btn action-edit" title="{!! __('general.edit') !!}">
        <i class="icon-pencil"></i>
    </a>

    <button type="button" class="action-icon-btn action-delete js-delete-btn"
        data-url="{!! route('dashboard.sliders.destroy') !!}" data-id="{!! $slider->id !!}" title="{!! __('general.delete') !!}">
        <i class="ti-trash"></i>
    </button>
</div>
