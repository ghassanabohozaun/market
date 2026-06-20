@if ($slider->status == 1)
    <span class="badge slider-status-{{ $slider->id }} badge-opacity-success rounded-pill fw-medium px-3 py-1">
        <i class="mdi mdi-check-circle-outline me-1"></i>
        {!! __('general.active') !!}
    </span>
@else
    <span class="badge slider-status-{{ $slider->id }} badge-opacity-danger rounded-pill fw-medium px-3 py-1">
        <i class="mdi mdi-close-circle-outline me-1"></i>
        {!! __('general.inactive') !!}
    </span>
@endif
