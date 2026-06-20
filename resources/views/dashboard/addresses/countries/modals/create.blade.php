<div class="modal fade" id="createCountryModal" tabindex="-1" role="dialog" aria-labelledby="createCountryModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample" action="{!! route('dashboard.addresses.countries.store') !!}" method="POST" enctype="multipart/form-data"
            id='create_country_form'>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCountryModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>{!! __('addresses.create_new_country') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar" class="form-label-premium">{!! __('addresses.country_name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_ar" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_country_name_ar') !!}">
                                </div>
                                <strong id="name_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en" class="form-label-premium">{!! __('addresses.country_name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_en" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_country_name_en') !!}">
                                </div>
                                <strong id="name_en_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="phone_code" class="form-label-premium">{!! __('addresses.phone_code') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                    <input type="text" id="phone_code" name="phone_code" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_phone_code') !!}">
                                </div>
                                <strong id="phone_code_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="flag_code" class="form-label-premium">{!! __('addresses.flag_code') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text">
                                        <span id="flag_preview" class="flag-icon flag-icon-default shadow-sm rounded-1"
                                            style="width: 20px; height: 15px;"></span>
                                    </span>
                                    <input type="text" id="flag_code" name="flag_code"
                                        class="form-control open-flags-reference" readonly autocomplete="off"
                                        placeholder="{!! __('addresses.select_flag_code') !!}" style="cursor: pointer;"
                                        data-target-input="flag_code">
                                    <span class="input-group-text open-flags-reference" style="cursor: pointer;"
                                        data-target-input="flag_code">
                                        <i class="ti-mouse-alt text-muted"></i>
                                    </span>
                                </div>
                                <strong id="flag_code_error" class="text-danger small"></strong>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group mb-2 theme-success">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i class="mdi mdi-power"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="status_active">{!! __('addresses.status') !!} <span
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
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Buttons removed in favor of Floating Command HUD -->
                </div>

                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="create_country_form" hudId="create_country_hud"
                    countId="create_country_count" discardId="create_country_discard"
                    submitId="create_country_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $('#createCountryModal').on('hidden.bs.modal', function() {
            window.clearFormErrors('#create_country_form');
            $('#create_country_form')[0].reset();
            $('#flag_preview').attr('class', 'flag-icon flag-icon-default shadow-sm rounded-1');
        });

        // Update flag preview on change
        $('#flag_code').on('change', function() {
            const code = $(this).val();
            if (code) {
                $('#flag_preview').attr('class', `flag-icon flag-icon-${code.toLowerCase()} shadow-sm rounded-1`);
            } else {
                $('#flag_preview').attr('class', 'flag-icon flag-icon-default shadow-sm rounded-1');
            }
        });

        window.handleFormSubmit('#create_country_form', {
            modalToHide: '#createCountryModal',
            successMessage: "{!! __('general.add_success_message') !!}",
            onSuccess: function() {
                if (window.activeHud) window.activeHud.changedFields.clear(); // Clear tracking on success
            }
        });

        // Initialize HUD when modal opens
        $('#createCountryModal').on('shown.bs.modal', function() {
            initHud('create_country_form', {
                hudId: 'create_country_hud',
                countId: 'create_country_count',
                discardId: 'create_country_discard',
                submitId: 'create_country_save'
            });
        });
    </script>
@endpush
