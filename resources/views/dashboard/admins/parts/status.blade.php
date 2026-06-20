@if ($admin->status == 1)
    <span class="badge admin_status_{{ $admin->id }} badge-opacity-success rounded-pill fw-medium px-3 py-1">
        <i class="mdi mdi-check-circle-outline me-1"></i>
        {!! __('general.active') !!}
    </span>
@else
    <span class="badge admin_status_{{ $admin->id }} badge-opacity-danger rounded-pill fw-medium px-3 py-1">
        <i class="mdi mdi-close-circle-outline me-1"></i>
        {!! __('general.inactive') !!}
    </span>
@endif
