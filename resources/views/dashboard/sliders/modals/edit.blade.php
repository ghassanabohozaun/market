<div class="modal fade" id="editSliderModal" tabindex="-1" role="dialog" aria-labelledby="editSliderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-uw" role="document">
        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data" id="edit_slider_form">
            @csrf
            @method('PUT')
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="editSliderModalLabel">
                        <i class="mdi mdi-pencil text-primary me-2"></i>{!! __('sliders.update_slider') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="slider_id_edit" name="id">

                    <div class="row g-4">
                        <!-- Arabic Title -->
                        <div class="col-md-6 theme-primary">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="title_ar_edit">{!! __('sliders.title_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-format-title text-primary"></i></span>
                                    <input type="text" id="title_ar_edit" name="title[ar]" class="form-control"
                                        placeholder="{!! __('sliders.enter_title_ar') !!}" autocomplete="off">
                                </div>
                                <strong id="title_ar_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                        <!-- English Title -->
                        <div class="col-md-6 theme-info">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="title_en_edit">{!! __('sliders.title_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-format-title text-primary"></i></span>
                                    <input type="text" id="title_en_edit" name="title[en]" class="form-control"
                                        placeholder="{!! __('sliders.enter_title_en') !!}" autocomplete="off">
                                </div>
                                <strong id="title_en_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>

                        <!-- Arabic Details -->
                        <div class="col-md-6 theme-primary">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="details_ar_edit">{!! __('sliders.details_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <textarea id="details_ar_edit" name="details[ar]" class="form-control" rows="3"
                                        placeholder="{!! __('sliders.enter_details_ar') !!}"></textarea>
                                </div>
                                <strong id="details_ar_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                        <!-- English Details -->
                        <div class="col-md-6 theme-info">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="details_en_edit">{!! __('sliders.details_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <textarea id="details_en_edit" name="details[en]" class="form-control" rows="3"
                                        placeholder="{!! __('sliders.enter_details_en') !!}"></textarea>
                                </div>
                                <strong id="details_en_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>

                        <!-- Arabic URL -->
                        <div class="col-md-6 theme-primary">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="url_ar_edit">{!! __('sliders.url_ar') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-link-variant text-primary"></i></span>
                                    <input type="text" id="url_ar_edit" name="url[ar]" class="form-control"
                                        placeholder="{!! __('sliders.enter_url_ar') !!}">
                                </div>
                                <strong id="url_ar_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                        <!-- English URL -->
                        <div class="col-md-6 theme-info">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="url_en_edit">{!! __('sliders.url_en') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-link-variant text-primary"></i></span>
                                    <input type="text" id="url_en_edit" name="url[en]" class="form-control"
                                        placeholder="{!! __('sliders.enter_url_en') !!}">
                                </div>
                                <strong id="url_en_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>

                        <!-- Photo Upload -->
                        <div class="col-md-12">
                            <x-dashboard.file-input name="photo" id="photo_edit" label="{!! __('sliders.photo') !!}"
                                placeholderIcon="mdi-image-outline" placeholderText="1920 × 742"
                                currentImageUrl="javascript:void(0)" isRequired="false" errorId="photo_error_edit" />
                            <small class="text-muted mt-1 d-block text-center w-100">
                                <i class="mdi mdi-information-outline me-1"></i>{!! __('sliders.slider_size') !!} (1920 × 742)
                            </small>
                        </div>

                        <!-- Toggles -->
                        <div class="col-md-4 theme-success">
                            <div class="form-group mb-0">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i class="mdi mdi-power text-success"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="status_active_edit">{!! __('sliders.status') !!} <span
                                                class="text-danger">*</span></label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch" name="status"
                                                id="status_active_edit" value="1" style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="status_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-4 theme-warning">
                            <div class="form-group mb-0">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-format-list-bulleted-type text-warning"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="details_status_active_edit">{!! __('sliders.details_status') !!} <span
                                                class="text-danger">*</span></label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="details_status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch" name="details_status"
                                                id="details_status_active_edit" value="1" style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="details_status_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-4 theme-info">
                            <div class="form-group mb-0">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-gesture-tap-button text-info"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="button_status_active_edit">{!! __('sliders.button_status') !!} <span
                                                class="text-danger">*</span></label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="button_status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch" name="button_status"
                                                id="button_status_active_edit" value="1" style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="button_status_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="edit_slider_form" hudId="edit_slider_hud"
                    countId="edit_slider_count" discardId="edit_slider_discard" submitId="edit_slider_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // --- Slider Edit Populate Logic (Using Generic Helper) ---
            window.populateModal('.js-edit-slider', {
                modal: '#editSliderModal',
                form: '#edit_slider_form',
                actionUrl: "{{ route('dashboard.sliders.update', ':id') }}",
                idKey: 'sliderId', // Matches data-slider-id
                suffix: '_edit',
                onAfterPopulate: function(btn, data, form) {
                    var $previewContainer = $('#photo_edit_preview');
                    var $img = $previewContainer.find('.fileinput-current-img');
                    var $placeholder = $previewContainer.find('.fileinput-placeholder');
                    var $resetBtn = $('#reset_photo_edit_btn');

                    // Standard pattern for populating file input in edit modal
                    if (data.photo && data.photo !== "" && data.photo !== "null") {
                        var photoUrl = data.photo;

                        // Set original state for HUD discard
                        $previewContainer.data('original-html',
                            `<img src="${photoUrl}" class="fileinput-current-img" style="width:100%; height:100%; object-fit:contain; background-color: #f8f9fa;">`
                        );

                        $('#photo_edit').val(''); // Clear any previous selection
                        $placeholder.addClass('d-none');
                        $img.attr('src', photoUrl).removeClass('d-none');
                        $previewContainer.closest('.fileinput-component').find('.slider-upload-card')
                            .removeClass('d-none');
                    } else {
                        $previewContainer.data('original-html', '');
                        $img.addClass('d-none').attr('src', '');
                        $placeholder.removeClass('d-none');
                        $resetBtn.addClass('d-none');
                    }

                    // Initialize HUD after population
                    if (window.activeHud) window.activeHud.changedFields.clear();
                    initHud('edit_slider_form', {
                        hudId: 'edit_slider_hud',
                        countId: 'edit_slider_count',
                        discardId: 'edit_slider_discard',
                        submitId: 'edit_slider_save'
                    });
                }
            });

            // --- Slider Edit Form Handler ---
            window.handleFormSubmit('#edit_slider_form', {
                modalToHide: '#editSliderModal',
                tableToLoad: '.js-sliders-table',
                successMessage: "{!! __('general.update_success_message') !!}",
                suffix: "_edit",
                resetForm: false,
                onSuccess: function() {
                    if (window.activeHud) window.activeHud.changedFields.clear();
                }
            });

            // --- Reset on Close ---
            $('#editSliderModal').on('hidden.bs.modal', function() {
                window.clearFormErrors('#edit_slider_form');
                // Trigger local reset to clear preview image correctly
                $('#reset_photo_edit_btn').click();
            });
        });
    </script>
@endpush
