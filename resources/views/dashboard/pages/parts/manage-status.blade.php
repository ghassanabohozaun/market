<div class="form-check form-switch d-flex justify-content-center align-items-center m-0 p-0">
    <input type="checkbox" class="form-check-input mt-0 js-status-change cursor-pointer"
        {{ $page->status == 1 ? 'checked' : '' }} id="status-manage-{{ $page->id }}" data-id="{{ $page->id }}"
        data-url="{{ route('dashboard.pages.change.status') }}" data-badge-prefix="page_status_" role="switch"
        style="width: 2.5rem; height: 1.25rem;">
</div>
