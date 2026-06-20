<div class="form-check form-switch d-flex justify-content-center align-items-center m-0 p-0">
    <input class="form-check-input mt-0 js-status-change cursor-pointer" type="checkbox" role="switch"
        data-id="{{ $category->id }}" data-url="{{ route('dashboard.categories.change.status') }}"
        data-badge-prefix="category_status_" style="width: 2.5rem; height: 1.25rem;"
        {{ $category->status == 1 ? 'checked' : '' }}>
</div>
