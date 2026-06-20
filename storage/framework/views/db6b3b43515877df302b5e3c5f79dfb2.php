<?php $__env->startSection('title'); ?>
    <?php echo $title; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-md-flex align-items-center justify-content-between border-bottom mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(route('dashboard.index')); ?>"><?php echo __('dashboard.dashboard'); ?></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(route('dashboard.roles.index')); ?>"><?php echo __('roles.roles'); ?></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo __('roles.update_role'); ?></li>
                            </ol>
                        </nav>
                        <div class="btn-wrapper">
                            <a href="<?php echo e(route('dashboard.roles.index')); ?>" class="btn btn-outline-dark btn-sm me-0 custom-shadow-sm">
                                <i class="mdi mdi-arrow-left"></i> <?php echo __('general.back'); ?>

                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo __('roles.update_role'); ?></h4>
                            <form class="forms-sample" id="role_form" action="<?php echo route('dashboard.roles.update', $role->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="id" value="<?php echo e($role->id); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 theme-primary">
                                            <label for="role_ar" class="form-label-premium"><?php echo __('roles.role_ar'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                                <input type="text" class="form-control" id="role_ar" name="role[ar]"
                                                    value="<?php echo old('role.ar', $role->getTranslation('role', 'ar')); ?>" placeholder="<?php echo __('roles.enter_role_ar'); ?>">
                                            </div>
                                            <strong id="role_ar_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 theme-primary">
                                            <label for="role_en" class="form-label-premium"><?php echo __('roles.role_en'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                                <input type="text" class="form-control" id="role_en" name="role[en]"
                                                    value="<?php echo old('role.en', $role->getTranslation('role', 'en')); ?>" placeholder="<?php echo __('roles.enter_role_en'); ?>">
                                            </div>
                                            <strong id="role_en_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <label class="mb-3 form-label-premium"><i
                                                class="mdi mdi-shield-check-outline me-1 text-primary"></i><?php echo __('roles.permissions'); ?>

                                            <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = config('global.permissions'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-3 mb-2">
                                                    <div class="form-check form-check-flat form-check-primary">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="permissions[]" value="<?php echo $key; ?>"
                                                                <?php if(in_array($key, $role->permissions)): echo 'checked'; endif; ?>>
                                                            <?php echo e(__(config('global.permissions.' . $key))); ?>

                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <strong id="permissions_error" class="text-danger small d-block mt-2"></strong>
                                    </div>
                                </div>

                                <!-- Floating Command HUD -->
                                <?php if (isset($component)) { $__componentOriginal3538477eb67f181dd8c1abfba3a6ad25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3538477eb67f181dd8c1abfba3a6ad25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.command-hud','data' => ['formId' => 'role_form']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.command-hud'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['formId' => 'role_form']); ?>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            // --- Initialize HUD ---
            initHud('role_form');

            window.handleFormSubmit('#role_form', {
                successMessage: "<?php echo __('general.update_success_message'); ?>",
                resetForm: false,
                onSuccess: function(data) {
                    if (window.activeHud) window.activeHud.changedFields
                        .clear(); // Clear tracking on success
                    setTimeout(() => {
                        window.location.href = "<?php echo route('dashboard.roles.index'); ?>";
                    }, 1000);
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.dashboard.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\market\resources\views/dashboard/roles/edit.blade.php ENDPATH**/ ?>