@if (!empty($page->photo))
    <div class="expandable-image-wrapper" data-img-url="{{ asset('uploads/pages/' . $page->photo) }}"
        data-title="{{ $page->getTranslation('title', Lang()) }}">
        <img src="{{ asset('uploads/pages/' . $page->photo) }}" alt="{{ $page->getTranslation('title', Lang()) }}"
            class="js-expandable-image" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
        <div class="image-overlay">
            <i class="mdi mdi-magnify"></i>
        </div>
    </div>
@else
    <div class="d-flex align-items-center justify-content-center bg-light border rounded"
        style="width: 40px; height: 40px; min-width: 40px; border-radius: 8px !important;">
        <i class="mdi mdi-text-box-outline text-muted" style="font-size: 1.2rem; opacity: 0.5;"></i>
    </div>
@endif
