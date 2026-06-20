@if ($testimonial->image)
    <a href="{{ asset('uploads/testimonials/' . $testimonial->image) }}" data-lightbox="testimonial-{{ $testimonial->id }}"
        data-title="{{ $testimonial->name }}">
        <img src="{{ asset('uploads/testimonials/' . $testimonial->image) }}" alt="Customer Image"
            class="img-fluid rounded-circle border shadow-sm"
            style="width: 50px; height: 50px; object-fit: cover; border-width: 2px !important; border-color: #f8f9fa !important;">
    </a>
@else
    <div class="rounded-circle d-flex align-items-center justify-content-center bg-light border shadow-sm text-primary fw-bold"
        style="width: 50px; height: 50px; font-size: 1.2rem;">
        {{ mb_substr($testimonial->name, 0, 1) }}
    </div>
@endif
