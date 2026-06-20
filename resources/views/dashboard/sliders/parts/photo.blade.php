@if ($slider->photo && file_exists(public_path('uploads/sliders/' . $slider->photo)))
    <div class="expandable-image-wrapper" data-img-url="{{ asset('uploads/sliders/' . $slider->photo) }}"
        data-title="{{ $slider->getTranslation('title', Lang()) }}">
        <img src="{{ asset('uploads/sliders/' . $slider->photo) }}" alt="{{ $slider->getTranslation('title', Lang()) }}"
            class="js-expandable-image" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
        <div class="image-overlay">
            <i class="mdi mdi-magnify"></i>
        </div>
    </div>
@else
    <div class="d-flex align-items-center justify-content-center bg-light border rounded"
        style="width: 40px; height: 40px; min-width: 40px; border-radius: 8px !important;">
        <i class="mdi mdi-image-outline text-muted" style="font-size: 1.2rem; opacity: 0.5;"></i>
    </div>
@endif
