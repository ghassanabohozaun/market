@push('css')
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/select2/select2.min.css') !!}">
@endpush
<div class="modal fade" id="createCityModal" tabindex="-1" role="dialog" aria-labelledby="createCityModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample" action="{!! route('dashboard.addresses.cities.store') !!}" method="POST" enctype="multipart/form-data"
            id='create_city_form'>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCityModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>{!! __('addresses.create_new_city') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar" class="form-label-premium">{!! __('addresses.city_name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_ar" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_city_name_ar') !!}">
                                </div>
                                <strong id="name_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en" class="form-label-premium">{!! __('addresses.city_name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_en" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_city_name_en') !!}">
                                </div>
                                <strong id="name_en_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="governorate_id" class="form-label-premium">{!! __('addresses.governorate_id') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-map-marker-outline"></i></span>
                                    <select class="governorate_select2_create" id='governorate_id' name="governorate_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <strong id="governorate_id_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <!-- Buttons removed in favor of Floating Command HUD -->
                </div>

            </div>
        </form>
    </div>
</div>

<!-- Floating Command HUD -->
<x-dashboard.command-hud formId="create_city_form" hudId="create_city_hud" countId="create_city_count"
    discardId="create_city_discard" submitId="create_city_save" />

@push('scripts')
    <script src="{!! asset('assets/dashboard/vendors/select2/select2.min.js') !!}"></script>

    <script type="text/javascript">
        window.initSelect2Autocomplete(".governorate_select2_create", {
            url: "{{ route('dashboard.addresses.governorates.autocomplete.governorate') }}",
            showFlag: false,
            dropdownParent: $('#createCityModal')
        });

        $('#createCityModal').on('hidden.bs.modal', function() {
            window.clearFormErrors('#create_city_form');
            $('#create_city_form')[0].reset();
            // Clear Select2 visually
            if ($.fn.select2) {
                $('#create_city_form').find("select").val(null).trigger("change");
            }
        });

        window.handleFormSubmit('#create_city_form', {
            modalToHide: '#createCityModal',
            successMessage: "{!! __('general.add_success_message') !!}"
        });

        // Ensure HUD slides down smoothly when modal starts closing
        $('#createCityModal').on('hide.bs.modal', function() {
            $('#create_city_hud').removeClass('visible');
        });

        // Initialize HUD when modal is shown
        $('#createCityModal').on('shown.bs.modal', function() {
            initHud('create_city_form', {
                hudId: 'create_city_hud',
                countId: 'create_city_count',
                discardId: 'create_city_discard',
                submitId: 'create_city_save'
            });
        });
    </script>
@endpush
