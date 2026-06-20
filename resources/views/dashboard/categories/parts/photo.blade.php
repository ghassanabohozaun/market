@if ($category->icon)
    <div class="expandable-image-wrapper" data-img-url="{{ asset('uploads/categories/' . $category->icon) }}"
        data-title="{{ $category->getTranslation('name', Lang()) }}">
        <img src="{{ asset('uploads/categories/' . $category->icon) }}"
            alt="{{ $category->getTranslation('name', Lang()) }}" class="js-expandable-image"
            style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
        <div class="image-overlay">
            <i class="mdi mdi-magnify"></i>
        </div>
    </div>
@else
    <div class="d-flex align-items-center justify-content-center bg-light border rounded-circle"
        style="width: 40px; height: 40px; min-width: 40px;">
        <i class="mdi mdi-shape-outline text-muted" style="font-size: 1.2rem; opacity: 0.5;"></i>
    </div>
@endif
