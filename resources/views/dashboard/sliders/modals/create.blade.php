<div class="modal fade" id="createSliderModal" tabindex="-1" role="dialog" aria-labelledby="createSliderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-uw" role="document">
        <form class="forms-sample" action="{{ route('dashboard.sliders.store') }}" method="POST"
            enctype="multipart/form-data" id="create_slider_form">
            @csrf
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="createSliderModalLabel">
                        <i class="mdi mdi-plus-circle text-primary me-2"></i>{!! __('sliders.create_new_slider') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <!-- Arabic Title -->
                        <div class="col-md-6 theme-primary">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="title_ar">{!! __('sliders.title_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-format-title text-primary"></i></span>
                                    <input type="text" id="title_ar" name="title[ar]" class="form-control"
                                        placeholder="{!! __('sliders.enter_title_ar') !!}" autocomplete="off">
                                </div>
                                <strong id="title_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <!-- English Title -->
                        <div class="col-md-6 theme-info">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="title_en">{!! __('sliders.title_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-format-title text-primary"></i></span>
                                    <input type="text" id="title_en" name="title[en]" class="form-control"
                                        placeholder="{!! __('sliders.enter_title_en') !!}" autocomplete="off">
                                </div>
                                <strong id="title_en_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <!-- Arabic Details -->
                        <div class="col-md-6 theme-primary">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="details_ar">{!! __('sliders.details_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <textarea id="details_ar" name="details[ar]" class="form-control" rows="3" placeholder="{!! __('sliders.enter_details_ar') !!}"></textarea>
                                </div>
                                <strong id="details_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <!-- English Details -->
                        <div class="col-md-6 theme-info">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="details_en">{!! __('sliders.details_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <textarea id="details_en" name="details[en]" class="form-control" rows="3" placeholder="{!! __('sliders.enter_details_en') !!}"></textarea>
                                </div>
                                <strong id="details_en_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <!-- Arabic URL -->
                        <div class="col-md-6 theme-primary">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="url_ar">{!! __('sliders.url_ar') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-link-variant text-primary"></i></span>
                                    <input type="text" id="url_ar" name="url[ar]" class="form-control"
                                        placeholder="{!! __('sliders.enter_url_ar') !!}">
                                </div>
                                <strong id="url_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <!-- English URL -->
                        <div class="col-md-6 theme-info">
                            <div class="form-group mb-0">
                                <label class="form-label-premium" for="url_en">{!! __('sliders.url_en') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-link-variant text-primary"></i></span>
                                    <input type="text" id="url_en" name="url[en]" class="form-control"
                                        placeholder="{!! __('sliders.enter_url_en') !!}">
                                </div>
                                <strong id="url_en_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <!-- Photo Upload -->
                        <div class="col-md-12">
                            <x-dashboard.file-input name="photo" id="create_slider_photo_input"
                                label="{!! __('sliders.photo') !!}" placeholderIcon="mdi-image-outline"
                                placeholderText="1920 × 742" isRequired="false" errorId="photo_error" />
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
                                            for="status_active">{!! __('sliders.status') !!} <span
                                                class="text-danger">*</span></label>
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
                        <div class="col-md-4 theme-warning">
                            <div class="form-group mb-0">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-format-list-bulleted-type text-warning"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="details_status_active">{!! __('sliders.details_status') !!} <span
                                                class="text-danger">*</span></label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="details_status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch" name="details_status"
                                                id="details_status_active" value="1" checked style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="details_status_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-4 theme-info">
                            <div class="form-group mb-0">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-gesture-tap-button text-info"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="button_status_active">{!! __('sliders.button_status') !!} <span
                                                class="text-danger">*</span></label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="button_status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch" name="button_status"
                                                id="button_status_active" value="1" checked style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="button_status_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="create_slider_form" hudId="create_slider_hud"
                    countId="create_slider_count" discardId="create_slider_discard" submitId="create_slider_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // --- Slider Create Form Handler ---
            window.handleFormSubmit('#create_slider_form', {
                modalToHide: '#createSliderModal',
                tableToLoad: '.js-sliders-table',
                successMessage: "{!! __('general.add_success_message') !!}",
                onSuccess: function() {
                    if (window.activeHud) window.activeHud.changedFields.clear();
                }
            });

            // Initialize HUD when modal is shown
            $('#createSliderModal').on('shown.bs.modal', function() {
                initHud('create_slider_form', {
                    hudId: 'create_slider_hud',
                    countId: 'create_slider_count',
                    discardId: 'create_slider_discard',
                    submitId: 'create_slider_save'
                });
            });
            // --- Reset Form on Close ---
            $('#createSliderModal').on('hidden.bs.modal', function() {
                const form = $('#create_slider_form');
                form[0].reset();
                window.clearFormErrors('#create_slider_form');

                // Reset HUD state
                if (window.activeHud) window.activeHud.changedFields.clear();

                // Trigger local reset to clear preview image correctly
                $('#reset_create_slider_photo_input_btn').click();
            });
        });
    </script>
@endpush
