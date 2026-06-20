<div class="d-flex justify-content-end gap-2">
    <!-- Edit Button -->
    <a href="javascript:void(0)" class="action-icon-btn action-edit edit-btn"
        data-id="{{ $testimonial->id }}"
        data-name-ar="{{ $testimonial->getTranslation('name', 'ar') }}"
        data-name-en="{{ $testimonial->getTranslation('name', 'en') }}"
        data-title-ar="{{ $testimonial->getTranslation('title', 'ar') }}"
        data-title-en="{{ $testimonial->getTranslation('title', 'en') }}"
        data-content-ar="{{ $testimonial->getTranslation('content', 'ar') }}"
        data-content-en="{{ $testimonial->getTranslation('content', 'en') }}"
        data-rating="{{ $testimonial->rating }}"
        data-status="{{ $testimonial->status }}"
        data-image="{{ $testimonial->image ? asset('uploads/testimonials/' . $testimonial->image) : '' }}"
        data-bs-toggle="modal" data-bs-target="#editTestimonialModal"
        title="{!! __('general.edit') !!}">
        <i class="icon-pencil"></i>
    </a>

    <!-- Delete Button -->
    <button type="button" class="action-icon-btn action-delete js-delete-btn" data-id="{{ $testimonial->id }}"
        data-url="{{ route('dashboard.testimonials.destroy') }}"
        title="{{ __('general.delete') }}">
        <i class="ti-trash"></i>
    </button>
</div>
