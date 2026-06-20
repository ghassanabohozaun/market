@push('css')
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/select2/select2.min.css') !!}">
@endpush
<div class="modal fade" id="createGovernorateModal" tabindex="-1" role="dialog" aria-labelledby="createGovernorateModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample" action="{!! route('dashboard.addresses.governorates.store') !!}" method="POST" enctype="multipart/form-data"
            id='create_governorate_form'>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGovernorateModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>{!! __('addresses.create_new_governorate') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar" class="form-label-premium">{!! __('addresses.governorate_name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_ar" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_governorate_name_ar') !!}">
                                </div>
                                <strong id="name_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en" class="form-label-premium">{!! __('addresses.governorate_name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_en" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_governorate_name_en') !!}">
                                </div>
                                <strong id="name_en_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="country_id" class="form-label-premium">{!! __('addresses.country_id') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-earth"></i></span>
                                    <select class="country_select2_create" id='country_id' name="country_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <strong id="country_id_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <!-- Buttons handled by Floating Command HUD -->
                </div>

            </div>
        </form>
    </div>
</div>

<!-- Floating Command HUD -->
<x-dashboard.command-hud formId="create_governorate_form" hudId="create_governorate_hud" countId="create_governorate_count"
    discardId="create_governorate_discard" submitId="create_governorate_save" />

@push('scripts')
    <script src="{!! asset('assets/dashboard/vendors/select2/select2.min.js') !!}"></script>

    <script type="text/javascript">
        window.initSelect2Autocomplete(".country_select2_create", {
            url: "{{ route('dashboard.addresses.countries.autocomplete.country') }}",
            showFlag: true,
            dropdownParent: $('#createGovernorateModal')
        });

        $('#createGovernorateModal').on('hidden.bs.modal', function() {
            window.clearFormErrors('#create_governorate_form');
            $('#create_governorate_form')[0].reset();
            // Clear Select2 visually
            if ($.fn.select2) {
                $('#create_governorate_form').find("select").val(null).trigger("change");
            }
        });

        window.handleFormSubmit('#create_governorate_form', {
            modalToHide: '#createGovernorateModal',
            successMessage: "{!! __('general.add_success_message') !!}",
            tableToLoad: "#responsiveTable"
        });

        // Ensure HUD slides down smoothly when modal starts closing
        $('#createGovernorateModal').on('hide.bs.modal', function() {
            $('#create_governorate_hud').removeClass('visible');
        });

        // Initialize HUD when modal is shown
        $('#createGovernorateModal').on('shown.bs.modal', function() {
            initHud('create_governorate_form', {
                hudId: 'create_governorate_hud',
                countId: 'create_governorate_count',
                discardId: 'create_governorate_discard',
                submitId: 'create_governorate_save'
            });
        });
    </script>
@endpush
