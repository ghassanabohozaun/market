<div class="modal fade" id="updateCountryModal" tabindex="-1" role="dialog" aria-labelledby="updateCountryModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data" id='update_country_form'>
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCountryModalLabel">
                        <i class="mdi mdi-pencil me-2"></i><?php echo __('addresses.update_country'); ?>

                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id_edit" name="id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar_edit" class="form-label-premium"><?php echo __('addresses.country_name_ar'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_ar_edit" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="<?php echo __('addresses.enter_country_name_ar'); ?>">
                                </div>
                                <strong id="name_ar_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en_edit" class="form-label-premium"><?php echo __('addresses.country_name_en'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_en_edit" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="<?php echo __('addresses.enter_country_name_en'); ?>">
                                </div>
                                <strong id="name_en_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="phone_code_edit" class="form-label-premium"><?php echo __('addresses.phone_code'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                    <input type="text" id="phone_code_edit" name="phone_code" class="form-control"
                                        autocomplete="off" placeholder="<?php echo __('addresses.enter_phone_code'); ?>">
                                </div>
                                <strong id="phone_code_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="flag_code_edit" class="form-label-premium"><?php echo __('addresses.flag_code'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text">
                                        <span id="flag_preview_edit"
                                            class="flag-icon flag-icon-default shadow-sm rounded-1"
                                            style="width: 20px; height: 15px;"></span>
                                    </span>
                                    <input type="text" id="flag_code_edit" name="flag_code"
                                        class="form-control open-flags-reference" readonly autocomplete="off"
                                        placeholder="<?php echo __('addresses.select_flag_code'); ?>" style="cursor: pointer;"
                                        data-target-input="flag_code_edit">
                                    <span class="input-group-text open-flags-reference" style="cursor: pointer;"
                                        data-target-input="flag_code_edit">
                                        <i class="ti-mouse-alt text-muted"></i>
                                    </span>
                                </div>
                                <strong id="flag_code_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group mb-2 theme-success">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i class="mdi mdi-power"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="status_active_edit"><?php echo __('addresses.status'); ?> <span
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
                <?php if (isset($component)) { $__componentOriginal3538477eb67f181dd8c1abfba3a6ad25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3538477eb67f181dd8c1abfba3a6ad25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.command-hud','data' => ['formId' => 'update_country_form','hudId' => 'update_country_hud','countId' => 'update_country_count','discardId' => 'update_country_discard','submitId' => 'update_country_save']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.command-hud'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['formId' => 'update_country_form','hudId' => 'update_country_hud','countId' => 'update_country_count','discardId' => 'update_country_discard','submitId' => 'update_country_save']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3538477eb67f181dd8c1abfba3a6ad25)): ?>
<?php $attributes = $__attributesOriginal3538477eb67f181dd8c1abfba3a6ad25; ?>
<?php unset($__attributesOriginal3538477eb67f181dd8c1abfba3a6ad25); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3538477eb67f181dd8c1abfba3a6ad25)): ?>
<?php $component = $__componentOriginal3538477eb67f181dd8c1abfba3a6ad25; ?>
<?php unset($__componentOriginal3538477eb67f181dd8c1abfba3a6ad25); ?>
<?php endif; ?>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        // --- Country Edit Populate Logic (Using Generic Helper) ---
        window.populateModal('.edit_country_button', {
            modal: '#updateCountryModal',
            form: '#update_country_form',
            actionUrl: "<?php echo route('dashboard.addresses.countries.update', ':id'); ?>",
            idKey: 'id',
            suffix: '_edit',
            onAfterPopulate: function(btn, data, form) {
                if (data.flagCode) {
                    $('#flag_preview_edit').attr('class',
                        `flag-icon flag-icon-${data.flagCode.toLowerCase()} shadow-sm rounded-1`);
                }
                if (window.activeHud) window.activeHud.changedFields.clear();
                initHud('update_country_form', {
                    hudId: 'update_country_hud',
                    countId: 'update_country_count',
                    discardId: 'update_country_discard',
                    submitId: 'update_country_save'
                });
            }
        });

        $('#updateCountryModal').on('hidden.bs.modal', function() {
            window.clearFormErrors('#update_country_form');
            $('#flag_preview_edit').attr('class', 'flag-icon flag-icon-default shadow-sm rounded-1');
        });

        // Update flag preview on change
        $('#flag_code_edit').on('change', function() {
            const code = $(this).val();
            if (code) {
                $('#flag_preview_edit').attr('class',
                    `flag-icon flag-icon-${code.toLowerCase()} shadow-sm rounded-1`);
            } else {
                $('#flag_preview_edit').attr('class', 'flag-icon flag-icon-default shadow-sm rounded-1');
            }
        });

        window.handleFormSubmit('#update_country_form', {
            modalToHide: '#updateCountryModal',
            successMessage: "<?php echo __('general.update_success_message'); ?>",
            suffix: '_edit',
            resetForm: false,
            onSuccess: function() {
                if (window.activeHud) window.activeHud.changedFields.clear(); // Clear tracking on success
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\market\resources\views/dashboard/addresses/countries/modals/edit.blade.php ENDPATH**/ ?>