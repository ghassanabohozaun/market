<div class="form-check form-switch d-flex justify-content-center align-items-center m-0 p-0">
    <input type="checkbox" class="form-check-input mt-0 js-status-change cursor-pointer"
        {{ $admin->status == 1 ? 'checked' : '' }} data-id="{{ $admin->id }}"
        data-url="{{ route('dashboard.admins.change.status') }}" data-badge-prefix="admin_status_" role="switch"
        style="width: 2.5rem; height: 1.25rem;">
</div>
