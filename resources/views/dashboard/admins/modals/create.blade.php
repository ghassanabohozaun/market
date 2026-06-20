<div class="modal fade" id="createAdminModal" tabindex="-1" role="dialog" aria-labelledby="createAdminModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample w-100" action="{!! route('dashboard.admins.store') !!}" method="POST" enctype="multipart/form-data"
            id="create_admin_form" novalidate>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAdminModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>{!! __('admins.create_new_admin') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar" class="form-label-premium">{!! __('admins.name_ar') !!}
                                    <span class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-account-card-outline"></i></span>
                                    <input type="text" id="name_ar" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('admins.enter_name_ar') !!}">
                                </div>
                                <strong id="name_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en" class="form-label-premium">{!! __('admins.name_en') !!}
                                    <span class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-account-card-outline"></i></span>
                                    <input type="text" id="name_en" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('admins.enter_name_en') !!}">
                                </div>
                                <strong id="name_en_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3 theme-primary">
                                <label for="email" class="form-label-premium">{!! __('admins.email') !!}
                                    <span class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                                    <input type="email" id="email" name="email" class="form-control"
                                        autocomplete="off" placeholder="{!! __('admins.enter_email') !!}">
                                </div>
                                <strong id="email_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3 theme-primary">
                                <label for="password" class="form-label-premium">{!! __('admins.password') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                                    <input type="password" id="password" name="password" class="form-control"
                                        autocomplete="new-password" placeholder="{!! __('admins.enter_password') !!}">
                                    <button type="button" class="password-toggle-btn js-password-toggle">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </button>
                                </div>
                                <strong id="password_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3 theme-primary">
                                <label for="password_confirm" class="form-label-premium">{!! __('admins.password_confirm') !!}
                                    <span class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-lock-check-outline"></i></span>
                                    <input type="password" id="password_confirm" name="password_confirm"
                                        class="form-control" autocomplete="new-password"
                                        placeholder="{!! __('admins.enter_password_confirm') !!}">
                                    <button type="button" class="password-toggle-btn js-password-toggle">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </button>
                                </div>
                                <strong id="password_confirm_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="role_id" class="form-label-premium">{!! __('admins.role_id') !!}
                                    <span class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-shield-account-outline"></i></span>
                                    <select class="form-select" id="role_id" name="role_id">
                                        <option value="" selected>{!! __('general.select_from_list') !!}</option>
                                        @foreach ($roles as $role)
                                            <option value="{!! $role->id !!}">{!! $role->role !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <strong id="role_id_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-12">
                            <x-dashboard.file-input name="photo" id="photo"
                                label="{!! __('admins.photo') !!} <span class='text-danger'>*</span>"
                                placeholderIcon="mdi-account-outline" errorId="photo_error" isRequired="false" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i class="mdi mdi-power"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="status_active">{!! __('admins.status') !!} <span
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
                <x-dashboard.command-hud formId="create_admin_form" hudId="create_admin_hud"
                    countId="create_admin_count" discardId="create_admin_discard" submitId="create_admin_save" />
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        // reset
        function resetCreateForm() {
            $('#create_admin_form')[0].reset();
            window.clearFormErrors('#create_admin_form');

            // default values
            if (document.getElementById('password')) document.getElementById('password').type = 'password';
            if (document.getElementById('password_confirm')) document.getElementById('password_confirm').type = 'password';

            // reset photo using local reset button
            $('#reset_photo_create_btn').click();
        }

        // hide
        $('#createAdminModal').on('hidden.bs.modal', function(e) {
            resetCreateForm();
        });

        window.handleFormSubmit('#create_admin_form', {
            modalToHide: '#createAdminModal',
            tableToLoad: '#responsiveTable',
            successMessage: "{!! __('general.add_success_message') !!}",
            onSuccess: function() {
                resetCreateForm();
            }
        });

        // Initialize HUD when modal is shown
        $('#createAdminModal').on('shown.bs.modal', function() {
            initHud('create_admin_form', {
                hudId: 'create_admin_hud',
                countId: 'create_admin_count',
                discardId: 'create_admin_discard',
                submitId: 'create_admin_save'
            });
        });
    </script>
@endpush
