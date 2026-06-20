<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample" action="{!! route('dashboard.profile.change.password') !!}" method="POST" enctype="multipart/form-data"
            id="change_passowrd_form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">
                        <i class="ti-lock me-2 text-primary" style="font-size: 1rem;"></i>
                        {!! __('profile.change_password') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="form-label-premium"><i
                                        class="mdi mdi-lock me-1 text-primary"></i>{!! __('admins.password') !!} <span
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

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password_confirm" class="form-label-premium"><i
                                        class="mdi mdi-lock me-1 text-primary"></i>{!! __('admins.password_confirm') !!} <span
                                        class="text-danger">*</span></label>
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
                </div>

                <div class="modal-footer">
                    <!-- Buttons removed in favor of Floating Command HUD -->
                </div>

                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="change_passowrd_form" hudId="change_password_hud"
                    countId="change_password_count" discardId="change_password_discard"
                    submitId="change_password_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        function resetChangePasswordForm() {
            $('#change_passowrd_form')[0].reset();
            window.clearFormErrors('#change_passowrd_form');
            if (document.getElementById('password')) document.getElementById('password').type = 'password';
            if (document.getElementById('password_confirm')) document.getElementById('password_confirm').type = 'password';
        }

        $('#changePasswordModal').on('hidden.bs.modal', function(e) {
            resetChangePasswordForm();
        });

        window.handleFormSubmit('#change_passowrd_form', {
            modalToHide: '#changePasswordModal',
            successMessage: "{!! __('general.update_success_message') !!}",
            onSuccess: function() {
                resetChangePasswordForm();
                if (window.activeHud) window.activeHud.changedFields.clear();
            }
        });

        // Initialize HUD when modal is shown
        $('#changePasswordModal').on('shown.bs.modal', function() {
            initHud('change_passowrd_form', {
                hudId: 'change_password_hud',
                countId: 'change_password_count',
                discardId: 'change_password_discard',
                submitId: 'change_password_save'
            });
        });
    </script>
@endpush
