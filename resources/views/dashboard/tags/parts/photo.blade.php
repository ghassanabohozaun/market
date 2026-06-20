@if ($tag->logo && file_exists(public_path('uploads/tags/' . $tag->logo)))
    <div class="expandable-image-wrapper" data-img-url="{{ asset('uploads/tags/' . $tag->logo) }}"
        data-title="{{ $tag->name }}">
        <img src="{{ asset('uploads/tags/' . $tag->logo) }}" alt="{{ $tag->name }}"
            class="js-expandable-image" style="width: 40px; height: 40px; object-fit: contain; border-radius: 8px;">
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
