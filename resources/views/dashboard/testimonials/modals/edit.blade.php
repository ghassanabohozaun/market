<div class="modal fade" id="editTestimonialModal" tabindex="-1" role="dialog" aria-labelledby="editTestimonialModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample w-100" action="" method="POST" enctype="multipart/form-data" id="edit_testimonial_form">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTestimonialModalLabel">
                        <i class="mdi mdi-pencil-circle me-2"></i>{!! __('testimonials.edit') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_name_ar" class="form-label-premium">{!! __('testimonials.name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-account-circle-outline"></i></span>
                                    <input type="text" id="edit_name_ar" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.name_ar') !!}">
                                </div>
                                <strong id="edit_name_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_name_en" class="form-label-premium">{!! __('testimonials.name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-account-circle-outline"></i></span>
                                    <input type="text" id="edit_name_en" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.name_en') !!}">
                                </div>
                                <strong id="edit_name_en_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_title_ar" class="form-label-premium">{!! __('testimonials.title_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="edit_title_ar" name="title[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.title_ar') !!}">
                                </div>
                                <strong id="edit_title_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_title_en" class="form-label-premium">{!! __('testimonials.title_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="edit_title_en" name="title[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.title_en') !!}">
                                </div>
                                <strong id="edit_title_en_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_content_ar" class="form-label-premium">{!! __('testimonials.content_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-text"></i></span>
                                    <textarea id="edit_content_ar" name="content[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.content_ar') !!}"></textarea>
                                </div>
                                <strong id="edit_content_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_content_en" class="form-label-premium">{!! __('testimonials.content_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-text"></i></span>
                                    <textarea id="edit_content_en" name="content[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.content_en') !!}"></textarea>
                                </div>
                                <strong id="edit_content_en_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_rating" class="form-label-premium">{!! __('testimonials.rating') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-star"></i></span>
                                    <select id="edit_rating" name="rating" class="form-control form-select">
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <strong id="edit_rating_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <x-dashboard.file-input name="image" id="edit_image"
                                label="{!! __('testimonials.image') !!}"
                                placeholderIcon="mdi-image-outline" errorId="edit_image_error" isRequired="false" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-2 theme-success">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i class="mdi mdi-power"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="edit_status_active">{!! __('testimonials.status') !!}</label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch"
                                                name="status" id="edit_status_active" value="1"
                                                style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="edit_status_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <x-dashboard.command-hud formId="edit_testimonial_form" hudId="edit_testimonial_hud"
                    countId="edit_testimonial_count" discardId="edit_testimonial_discard" submitId="edit_testimonial_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var nameAr = $(this).data('name-ar');
            var nameEn = $(this).data('name-en');
            var titleAr = $(this).data('title-ar');
            var titleEn = $(this).data('title-en');
            var contentAr = $(this).data('content-ar');
            var contentEn = $(this).data('content-en');
            var rating = $(this).data('rating');
            var status = $(this).data('status');
            var image = $(this).data('image');

            $('#edit_id').val(id);
            $('#edit_name_ar').val(nameAr);
            $('#edit_name_en').val(nameEn);
            $('#edit_title_ar').val(titleAr);
            $('#edit_title_en').val(titleEn);
            $('#edit_content_ar').val(contentAr);
            $('#edit_content_en').val(contentEn);
            $('#edit_rating').val(rating);

            if (status == 1) {
                $('#edit_status_active').prop('checked', true);
            } else {
                $('#edit_status_active').prop('checked', false);
            }

            if (image) {
                var component = $('#edit_image').closest('.fileinput-component');
                var currentImg = component.find('.fileinput-current-img');
                var placeholder = component.find('.fileinput-placeholder');
                
                // Clear any dynamic previews from previous uploads
                component.find('.fileinput-dynamic-preview').remove();
                $('#edit_image').val('');
                
                currentImg.attr('src', image).removeClass('d-none');
                placeholder.addClass('d-none');
                component.attr('data-mode', 'edit');
                component.find('.fileinput-deleted-flag').val('0');
            } else {
                var component = $('#edit_image').closest('.fileinput-component');
                var currentImg = component.find('.fileinput-current-img');
                var placeholder = component.find('.fileinput-placeholder');
                
                // Clear any dynamic previews from previous uploads
                component.find('.fileinput-dynamic-preview').remove();
                $('#edit_image').val('');
                
                currentImg.attr('src', '').addClass('d-none');
                placeholder.removeClass('d-none');
                component.attr('data-mode', 'create');
                component.find('.fileinput-deleted-flag').val('1');
            }

            var formAction = "{{ route('dashboard.testimonials.update', ['testimonial' => ':id']) }}";
            formAction = formAction.replace(':id', id);
            $('#edit_testimonial_form').attr('action', formAction);

            window.clearFormErrors('#edit_testimonial_form');
        });

        $('#editTestimonialModal').on('shown.bs.modal', function() {
            initHud('edit_testimonial_form', {
                hudId: 'edit_testimonial_hud',
                countId: 'edit_testimonial_count',
                discardId: 'edit_testimonial_discard',
                submitId: 'edit_testimonial_save'
            });
        });

        function resetEditForm() {
            window.clearFormErrors('#edit_testimonial_form');
            $('#reset_edit_image_btn').click();
        }

        $('#editTestimonialModal').on('hidden.bs.modal', function() {
            resetEditForm();
        });

        window.handleFormSubmit('#edit_testimonial_form', {
            modalToHide: '#editTestimonialModal',
            tableToLoad: '#responsiveTable',
            successMessage: "{!! __('general.update_success_message') !!}"
        });
    </script>
@endpush
