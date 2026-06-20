<div class="modal fade" id="createtagModal" tabindex="-1" role="dialog" aria-labelledby="createtagModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample w-100" action="{!! route('dashboard.tags.store') !!}" method="POST" enctype="multipart/form-data"
            id="create_tag_form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createtagModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>{!! __('tags.create_new_tag') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar" class="form-label-premium">{!! __('tags.name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_ar" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('tags.enter_name_ar') !!}">
                                </div>
                                <strong id="name_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en" class="form-label-premium">{!! __('tags.name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_en" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('tags.enter_name_en') !!}">
                                </div>
                                <strong id="name_en_error" class="text-danger small"></strong>
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
                                            for="status_active">{!! __('general.status') !!}</label>
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
                <x-dashboard.command-hud formId="create_tag_form" hudId="create_tag_hud"
                    countId="create_tag_count" discardId="create_tag_discard"
                    submitId="create_tag_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        function resetCreateForm() {
            $('#create_tag_form')[0].reset();
            window.clearFormErrors('#create_tag_form');
            $('#reset_photo_create_btn').click();
        }

        $('#createtagModal').on('hidden.bs.modal', function() {
            resetCreateForm();
        });

        $('#createtagModal').on('shown.bs.modal', function() {
            initHud('create_tag_form', {
                hudId: 'create_tag_hud',
                countId: 'create_tag_count',
                discardId: 'create_tag_discard',
                submitId: 'create_tag_save'
            });
        });

        window.handleFormSubmit('#create_tag_form', {
            modalToHide: '#createtagModal',
            tableToLoad: '#responsiveTable',
            successMessage: "{!! __('general.add_success_message') !!}",
            onSuccess: function() {
                resetCreateForm();
            }
        });
    </script>
@endpush
