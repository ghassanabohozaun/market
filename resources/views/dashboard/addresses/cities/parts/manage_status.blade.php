<div class="form-check form-switch d-flex justify-content-center align-items-center m-0 p-0">
    <input type="checkbox" class="form-check-input js-status-change cursor-pointer"
        {{ $city->status == 1 ? 'checked' : '' }} data-id="{{ $city->id }}"
        data-url="{{ route('dashboard.addresses.cities.change.status') }}" data-badge-prefix="city_status_"
        role="switch" style="width: 2.5rem; height: 1.25rem;">
</div>
