<div class="form-check form-switch d-flex justify-content-center align-items-center m-0 p-0">
    <input type="checkbox" class="form-check-input mt-0 js-status-change cursor-pointer" role="switch"
        id="status-manage-{{ $slider->id }}" data-id="{{ $slider->id }}"
        data-url="{{ route('dashboard.sliders.change.status') }}" data-badge-prefix="slider-status-"
        style="width: 2.5rem; height: 1.25rem;" {{ $slider->status == 1 ? 'checked' : '' }}>
</div>
