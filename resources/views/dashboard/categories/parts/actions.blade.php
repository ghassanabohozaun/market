<div class="d-flex justify-content-end gap-2">



    <a href="javascript:void(0)" class="action-icon-btn action-edit edit-btn"
        title="{!! __('general.edit') !!}" data-id="{{ $category->id }}"
        data-name-ar="{{ $category->getTranslation('name', 'ar') }}"
        data-name-en="{{ $category->getTranslation('name', 'en') }}"
        data-slug-ar="{{ $category->getTranslation('slug', 'ar') }}"
        data-slug-en="{{ $category->getTranslation('slug', 'en') }}" data-parent="{{ $category->parent }}"
        data-status-active="{{ $category->status }}" data-photo="{!! $category->icon !!}">
        <i class="icon-pencil"></i>
    </a>

    <button type="button" class="action-icon-btn action-delete js-delete-btn"
        data-id="{{ $category->id }}" data-url="{{ route('dashboard.categories.destroy') }}"
        title="{!! __('general.delete') !!}">
        <i class="ti-trash"></i>
    </button>
</div>
