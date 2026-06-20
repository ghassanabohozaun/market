<div class="modal fade" id="edittagModal" tabindex="-1" role="dialog" aria-labelledby="edittagModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample w-100" method="POST" enctype="multipart/form-data" id="edit_tag_form">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_id" name="id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edittagModalLabel">
                        <i class="mdi mdi-pencil-circle me-2"></i>{!! __('tags.update_tag') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_name_ar" class="form-label-premium">{!! __('tags.name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="edit_name_ar" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('tags.enter_name_ar') !!}">
                                </div>
                                <strong id="edit_name_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_name_en" class="form-label-premium">{!! __('tags.name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="edit_name_en" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('tags.enter_name_en') !!}">
                                </div>
                                <strong id="edit_name_en_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-2 theme-success">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i class="mdi mdi-power"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="edit_status">{!! __('general.status') !!}</label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch" name="status"
                                                id="edit_status" value="1" style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="edit_status_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="edit_tag_form" hudId="edit_tag_hud"
                    countId="edit_tag_count" discardId="edit_tag_discard" submitId="edit_tag_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.custom-edit-btn', function() {
            let id = $(this).data('id');
            let name_ar = $(this).data('name-ar');
            let name_en = $(this).data('name-en');
            let status = $(this).data('status');
            
            // Set values
            $('#edit_id').val(id);
            $('#edit_name_ar').val(name_ar);
            $('#edit_name_en').val(name_en);

            if (status == 1) {
                $('#edit_status').prop('checked', true);
            } else {
                $('#edit_status').prop('checked', false);
            }

            // Set Action
            let updateUrl = `{{ route('dashboard.tags.update', ':id') }}`.replace(':id', id);
            $('#edit_tag_form').attr('action', updateUrl);

        });

        $('#edittagModal').on('shown.bs.modal', function() {
            initHud('edit_tag_form', {
                hudId: 'edit_tag_hud',
                countId: 'edit_tag_count',
                discardId: 'edit_tag_discard',
                submitId: 'edit_tag_save'
            });
        });

        $('#edittagModal').on('hidden.bs.modal', function() {
            window.clearFormErrors('#edit_tag_form');
        });

        window.handleFormSubmit('#edit_tag_form', {
            modalToHide: '#edittagModal',
            tableToLoad: '#responsiveTable',
            successMessage: "{!! __('general.update_success_message') !!}"
        });
    </script>
@endpush
