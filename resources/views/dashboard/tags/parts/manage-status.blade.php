<div class="form-check form-switch d-flex justify-content-center align-items-center m-0 p-0">
    <input type="checkbox" class="form-check-input mt-0 js-status-change cursor-pointer" role="switch"
        id="status-manage-{{ $tag->id }}" data-id="{{ $tag->id }}"
        data-url="{{ route('dashboard.tags.change.status') }}" data-badge-prefix="tag_status_"
        style="width: 2.5rem; height: 1.25rem;" {{ $tag->status == 1 ? 'checked' : '' }}>
</div>
