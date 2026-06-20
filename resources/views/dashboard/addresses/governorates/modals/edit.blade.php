@push('css')
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/select2/select2.min.css') !!}">
@endpush
<div class="modal fade" id="updateGovernorateModal" tabindex="-1" role="dialog" aria-labelledby="updateGovernorateModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data" id='update_governorate_form'>
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateGovernorateModalLabel">
                        <i class="mdi mdi-pencil me-2"></i>{!! __('addresses.update_governorate') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id_edit_governorate" name="id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar_edit" class="form-label-premium">{!! __('addresses.governorate_name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_ar_edit" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_governorate_name_ar') !!}">
                                </div>
                                <strong id="name_ar_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en_edit" class="form-label-premium">{!! __('addresses.governorate_name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_en_edit" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('addresses.enter_governorate_name_en') !!}">
                                </div>
                                <strong id="name_en_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="country_id_edit" class="form-label-premium">{!! __('addresses.country_id') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-earth"></i></span>
                                    <select class="country_select2_edit" id='country_id_edit' name="country_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <strong id="country_id_error_edit" class="text-danger small"></strong>
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
<x-dashboard.command-hud formId="update_governorate_form" hudId="update_governorate_hud" countId="update_governorate_count"
    discardId="update_governorate_discard" submitId="update_governorate_save" />

@push('scripts')
    <script src="{!! asset('assets/dashboard/vendors/select2/select2.min.js') !!}"></script>

    <script type="text/javascript">
        window.initSelect2Autocomplete(".country_select2_edit", {
            url: "{{ route('dashboard.addresses.countries.autocomplete.country') }}",
            showFlag: true,
            dropdownParent: $('#updateGovernorateModal')
        });

        // show edit modal
        $('body').on('click', '.edit_governorate_button', function(e) {
            e.preventDefault();
            var gov_id = $(this).attr('governorate-id');
            var gov_name_ar = $(this).attr('governorate-name-ar');
            var gov_name_en = $(this).attr('governorate-name-en');
            var country_id = $(this).attr('country-id');

            // Set dynamic action URL
            const url = "{!! route('dashboard.addresses.governorates.update', 'id') !!}".replace('id', gov_id);
            $('#update_governorate_form').attr('action', url);

            $('#id_edit_governorate').val(gov_id);
            $('#name_ar_edit').val(gov_name_ar);
            $('#name_en_edit').val(gov_name_en);

            if (country_id) {
                var countryName = $(this).closest('tr').find('td').eq(3).text().trim();
                var countryFlag = $(this).attr('country-flag');
                var option = new Option(countryName, country_id, true, true);
                $(option).data('data', {
                    id: country_id,
                    text: countryName,
                    flag_code: countryFlag
                });
                $(".country_select2_edit").empty().append(option).trigger('change');
            } else {
                $(".country_select2_edit").empty().trigger('change');
            }

            $('#updateGovernorateModal').modal('show');
            if (window.activeHud) window.activeHud.changedFields.clear();
            initHud('update_governorate_form', {
                hudId: 'update_governorate_hud',
                countId: 'update_governorate_count',
                discardId: 'update_governorate_discard',
                submitId: 'update_governorate_save'
            });
        });

        $('#updateGovernorateModal').on('hidden.bs.modal', function() {
            window.clearFormErrors('#update_governorate_form');
        });

        // Ensure HUD slides down smoothly when modal starts closing
        $('#updateGovernorateModal').on('hide.bs.modal', function() {
            $('#update_governorate_hud').removeClass('visible');
        });

        window.handleFormSubmit('#update_governorate_form', {
            modalToHide: '#updateGovernorateModal',
            successMessage: "{!! __('general.update_success_message') !!}",
            suffix: '_edit',
            resetForm: false,
            tableToLoad: "#responsiveTable"
        });
    </script>
@endpush
