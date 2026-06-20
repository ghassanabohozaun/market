@if ($governorate->status == 1)
    <span class="badge governorate_status_{{ $governorate->id }} badge-opacity-success rounded-pill fw-medium px-3 py-1">
        <i class="mdi mdi-check-circle-outline me-1"></i>
        {!! __('general.enable') !!}
    </span>
@else
    <span class="badge governorate_status_{{ $governorate->id }} badge-opacity-danger rounded-pill fw-medium px-3 py-1">
        <i class="mdi mdi-close-circle-outline me-1"></i>
        {!! __('general.disabled') !!}
    </span>
@endif
