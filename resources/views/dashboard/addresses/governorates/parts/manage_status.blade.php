<div class="form-check form-switch d-flex justify-content-center align-items-center m-0 p-0">
    <input type="checkbox" class="form-check-input js-status-change cursor-pointer"
        {{ $governorate->status == 1 ? 'checked' : '' }} data-id="{{ $governorate->id }}"
        data-url="{{ route('dashboard.addresses.governorates.change.status') }}" data-badge-prefix="governorate_status_"
        role="switch" style="width: 2.5rem; height: 1.25rem;">
</div>
