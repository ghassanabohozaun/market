@push('css')
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/select2/select2.min.css') !!}">
@endpush
<div class="modal fade" id="updateCityModal" tabindex="-1" role="dialog" aria-labelledby="updateCityModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data" id='update_city_form'>
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCityModalLabel">
                        <i class="mdi mdi-pencil me-2"></i>{!! __('addresses.update_city') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id_edit_city" name="id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar_edit" class="form-label-premium">{!! __('addresses.city_name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_ar_edit" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_city_name_ar') !!}">
                                </div>
                                <strong id="name_ar_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en_edit" class="form-label-premium">{!! __('addresses.city_name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_en_edit" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_city_name_en') !!}">
                                </div>
                                <strong id="name_en_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="governorate_id_edit" class="form-label-premium">{!! __('addresses.governorate_id') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-map-marker-outline"></i></span>
                                    <select class="governorate_select2_edit" id='governorate_id_edit' name="governorate_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <strong id="governorate_id_error_edit" class="text-danger small"></strong>
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
<x-dashboard.command-hud formId="update_city_form" hudId="update_city_hud" countId="update_city_count"
    discardId="update_city_discard" submitId="update_city_save" />

@push('scripts')
    <script src="{!! asset('assets/dashboard/vendors/select2/select2.min.js') !!}"></script>

    <script type="text/javascript">
        window.initSelect2Autocomplete(".governorate_select2_edit", {
            url: "{{ route('dashboard.addresses.governorates.autocomplete.governorate') }}",
            showFlag: false,
            dropdownParent: $('#updateCityModal')
        });

        // show edit modal
        $('body').on('click', '.edit_city_button', function(e) {
            e.preventDefault();
            var city_id = $(this).attr('city-id');
            var city_name_ar = $(this).attr('city-name-ar');
            var city_name_en = $(this).attr('city-name-en');
            var governorate_id = $(this).attr('governorate-id');

            // Set dynamic action URL
            const url = "{!! route('dashboard.addresses.cities.update', 'id') !!}".replace('id', city_id);
            $('#update_city_form').attr('action', url);

            $('#id_edit_city').val(city_id);
            $('#name_ar_edit').val(city_name_ar);
            $('#name_en_edit').val(city_name_en);

            if (governorate_id) {
                var governorateName = $(this).closest('tr').find('td').eq(3).text().trim();
                var option = new Option(governorateName, governorate_id, true, true);
                $(option).data('data', {
                    id: governorate_id,
                    text: governorateName
                });
                $(".governorate_select2_edit").empty().append(option).trigger('change');
            } else {
                $(".governorate_select2_edit").empty().trigger('change');
            }

            $('#updateCityModal').modal('show');
            if (window.activeHud) window.activeHud.changedFields.clear();
            initHud('update_city_form', {
                hudId: 'update_city_hud',
                countId: 'update_city_count',
                discardId: 'update_city_discard',
                submitId: 'update_city_save'
            });
        });

        $('#updateCityModal').on('hidden.bs.modal', function() {
            window.clearFormErrors('#update_city_form');
        });

        // Ensure HUD slides down smoothly when modal starts closing
        $('#updateCityModal').on('hide.bs.modal', function() {
            $('#update_city_hud').removeClass('visible');
        });

        window.handleFormSubmit('#update_city_form', {
            modalToHide: '#updateCityModal',
            successMessage: "{!! __('general.update_success_message') !!}",
            suffix: '_edit',
            resetForm: false
        });
    </script>
@endpush
