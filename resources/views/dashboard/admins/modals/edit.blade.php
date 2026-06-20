<div class="modal fade" id="updateAdminModal" tabindex="-1" role="dialog" aria-labelledby="updateAdminModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample w-100" action="" method="POST" enctype="multipart/form-data" id="edit_admin_form"
            novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" id="id_edit" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAdminModalLabel">
                        <i class="mdi mdi-pencil me-2"></i>{!! __('admins.update_admin') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar_edit" class="form-label-premium">{!! __('admins.name_ar') !!}
                                    <span class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-account-card-outline"></i></span>
                                    <input type="text" id="name_ar_edit" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('admins.enter_name_ar') !!}">
                                </div>
                                <strong id="name_ar_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en_edit" class="form-label-premium">{!! __('admins.name_en') !!}
                                    <span class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-account-card-outline"></i></span>
                                    <input type="text" id="name_en_edit" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('admins.enter_name_en') !!}">
                                </div>
                                <strong id="name_en_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3 theme-primary">
                                <label for="email_edit" class="form-label-premium">{!! __('admins.email') !!}
                                    <span class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                                    <input type="email" id="email_edit" name="email" class="form-control"
                                        autocomplete="off" placeholder="{!! __('admins.enter_email') !!}">
                                </div>
                                <strong id="email_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3 theme-primary">
                                <label for="password_edit" class="form-label-premium">{!! __('admins.password') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                                    <input type="password" id="password_edit" name="password" class="form-control"
                                        autocomplete="new-password" placeholder="{!! __('admins.enter_password') !!}">
                                    <button type="button" class="password-toggle-btn js-password-toggle">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </button>
                                </div>
                                <strong id="password_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3 theme-primary">
                                <label for="password_confirm_edit"
                                    class="form-label-premium">{!! __('admins.password_confirm') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-lock-check-outline"></i></span>
                                    <input type="password" id="password_confirm_edit" name="password_confirm"
                                        class="form-control" autocomplete="new-password"
                                        placeholder="{!! __('admins.enter_password_confirm') !!}">
                                    <button type="button" class="password-toggle-btn js-password-toggle">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </button>
                                </div>
                                <strong id="password_confirm_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="role_id_edit" class="form-label-premium">{!! __('admins.role_id') !!}
                                    <span class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-shield-account-outline"></i></span>
                                    <select class="form-select" id="role_id_edit" name="role_id">
                                        <option value="">{!! __('general.select_from_list') !!}</option>
                                        @foreach ($roles as $role)
                                            <option value="{!! $role->id !!}">{!! $role->role !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <strong id="role_id_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-12">
                            <x-dashboard.file-input name="photo" id="photo_edit" label="{!! __('admins.photo') !!}"
                                placeholderIcon="mdi-account-outline" currentImageUrl="javascript:void(0)"
                                errorId="photo_error_edit" isRequired="false" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i class="mdi mdi-power"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="status_active_edit">{!! __('admins.status') !!} <span
                                                class="text-danger">*</span></label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch" name="status"
                                                id="status_active_edit" value="1" style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="status_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Buttons removed in favor of Floating Command HUD -->
                </div>

                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="edit_admin_form" hudId="edit_admin_hud" countId="edit_admin_count"
                    discardId="edit_admin_discard" submitId="edit_admin_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        // --- Admin Edit Populate Logic (Using Generic Helper) ---
        window.populateModal('.edit_admin_button', {
            modal: '#updateAdminModal',
            form: '#edit_admin_form',
            actionUrl: "{!! route('dashboard.admins.update', 'id') !!}",
            idKey: 'id',
            suffix: '_edit',
            onAfterPopulate: function(btn, data, form) {
                if (window.activeHud) window.activeHud.changedFields.clear();
                initHud('edit_admin_form', {
                    hudId: 'edit_admin_hud',
                    countId: 'edit_admin_count',
                    discardId: 'edit_admin_discard',
                    submitId: 'edit_admin_save'
                });
                var previewContainer = $('#photo_edit_preview');

                // Update dynamic delete ID
                var deleteBtn = previewContainer.find('.fileinput-backend-delete');
                if (deleteBtn.length) {
                    deleteBtn.attr('data-id', data.id);
                    deleteBtn.data('id', data.id);
                }

                var currentImg = previewContainer.find('.fileinput-current-img');
                var placeholder = previewContainer.find('.fileinput-placeholder');

                if (data.photo && data.photo !== "" && data.photo !== "null") {
                    var photoBase = "{{ asset('uploads/adminsPhotos') }}";
                    var photoUrl = photoBase + '/' + data.photo;

                    previewContainer.data('original-html',
                        `<img src="${photoUrl}" class="fileinput-current-img" style="width:100%; height:100%; object-fit:contain; background-color: #f8f9fa;">`
                    );

                    currentImg.attr('src', photoUrl).removeClass('d-none');
                    placeholder.addClass('d-none');
                    if (deleteBtn.length) deleteBtn.removeClass('d-none');
                } else {
                    previewContainer.data('original-html', '');
                    currentImg.addClass('d-none').attr('src', '');
                    placeholder.removeClass('d-none');
                    if (deleteBtn.length) deleteBtn.addClass('d-none');
                }
            }
        });

        // reset
        function resetEditForm() {
            window.clearFormErrors('#edit_admin_form');

            // reset password type
            if (document.getElementById('password_edit')) document.getElementById('password_edit').type = 'password';
            if (document.getElementById('password_confirm_edit')) document.getElementById('password_confirm_edit').type =
                'password';

            $('#reset_photo_edit_btn').click();
        }

        // hide
        $('#updateAdminModal').on('hidden.bs.modal', function(e) {
            resetEditForm();
        });

        window.handleFormSubmit('#edit_admin_form', {
            modalToHide: '#updateAdminModal',
            tableToLoad: '#responsiveTable',
            successMessage: "{!! __('general.update_success_message') !!}",
            suffix: '_edit',
            resetForm: false,
            onSuccess: function(data) {
                if (window.activeHud) window.activeHud.changedFields.clear();
                $('.admin_name_section').load(location.href + ' .admin_name_section');

                const admin_id = $('#id_edit').val();
                // Sync header if it's the current user
                if (admin_id == "{{ admin()->user()->id }}") {
                    if (data.data.photo) {
                        var photoUrl = "{{ asset('uploads/adminsPhotos') }}/" + data.data.photo;
                        $('.header_admin_photo').attr('src', photoUrl);
                    } else {
                        // If photo is removed or not present, reset to default or hide
                        $('.header_admin_photo').attr('src',
                            "{{ asset('dashboard/img/user.png') }}"); // Example default
                    }

                    var name = data.data.name;
                    if (typeof name === 'object' && name !== null) {
                        name = name["{!! app()->getLocale() !!}"];
                    }

                    $('.header_admin_name').text(name);
                    $('.header_admin_email').text(data.data.email);
                    $('.welcome-text span').text(name);
                }
            }
        });
    </script>
@endpush
