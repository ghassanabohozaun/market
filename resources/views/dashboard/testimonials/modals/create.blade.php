<div class="modal fade" id="createTestimonialModal" tabindex="-1" role="dialog" aria-labelledby="createTestimonialModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample w-100" action="{!! route('dashboard.testimonials.store') !!}" method="POST" enctype="multipart/form-data"
            id="create_testimonial_form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTestimonialModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>{!! __('testimonials.create_new') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar" class="form-label-premium">{!! __('testimonials.name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-account-circle-outline"></i></span>
                                    <input type="text" id="name_ar" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.name_ar') !!}">
                                </div>
                                <strong id="name_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en" class="form-label-premium">{!! __('testimonials.name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-account-circle-outline"></i></span>
                                    <input type="text" id="name_en" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.name_en') !!}">
                                </div>
                                <strong id="name_en_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="title_ar" class="form-label-premium">{!! __('testimonials.title_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="title_ar" name="title[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.title_ar') !!}">
                                </div>
                                <strong id="title_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="title_en" class="form-label-premium">{!! __('testimonials.title_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="title_en" name="title[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.title_en') !!}">
                                </div>
                                <strong id="title_en_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="content_ar" class="form-label-premium">{!! __('testimonials.content_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-text"></i></span>
                                    <textarea id="content_ar" name="content[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.content_ar') !!}"></textarea>
                                </div>
                                <strong id="content_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="content_en" class="form-label-premium">{!! __('testimonials.content_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-text"></i></span>
                                    <textarea id="content_en" name="content[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('testimonials.content_en') !!}"></textarea>
                                </div>
                                <strong id="content_en_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="rating" class="form-label-premium">{!! __('testimonials.rating') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-star"></i></span>
                                    <select id="rating" name="rating" class="form-control form-select">
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <strong id="rating_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <x-dashboard.file-input name="image" id="image"
                                label="{!! __('testimonials.image') !!}"
                                placeholderIcon="mdi-image-outline" errorId="image_error" isRequired="true" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-2 theme-success">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i class="mdi mdi-power"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="status_active">{!! __('testimonials.status') !!}</label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch" name="status"
                                                id="status_active" value="1" checked style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="status_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="create_testimonial_form" hudId="create_testimonial_hud"
                    countId="create_testimonial_count" discardId="create_testimonial_discard"
                    submitId="create_testimonial_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        function resetCreateForm() {
            $('#create_testimonial_form')[0].reset();
            window.clearFormErrors('#create_testimonial_form');
            $('#reset_image_input_btn').click(); // standard fallback
            $('#reset_image_btn').click();
        }

        $('#createTestimonialModal').on('hidden.bs.modal', function() {
            resetCreateForm();
        });

        $('#createTestimonialModal').on('shown.bs.modal', function() {
            initHud('create_testimonial_form', {
                hudId: 'create_testimonial_hud',
                countId: 'create_testimonial_count',
                discardId: 'create_testimonial_discard',
                submitId: 'create_testimonial_save'
            });
        });

        window.handleFormSubmit('#create_testimonial_form', {
            modalToHide: '#createTestimonialModal',
            tableToLoad: '#responsiveTable',
            successMessage: "{!! __('general.add_success_message') !!}",
            onSuccess: function() {
                resetCreateForm();
            }
        });
    </script>
@endpush
