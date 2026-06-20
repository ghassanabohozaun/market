<div class="table-responsive table-responsive-custom">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-start"><?php echo __('roles.role_name'); ?></th>
                <th class="text-start d-none d-md-table-cell"><?php echo __('roles.permissions'); ?></th>
                <th class="text-center"><?php echo __('general.actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="details-col">
                        <i class="mdi mdi-plus-circle details-control" data-title="<?php echo $role->role; ?>"></i>
                    </td>
                    <td class="text-start"><?php echo $loop->iteration; ?></td>
                    <td class="text-start"><?php echo $role->role; ?></td>
                    <td class="text-start d-none d-md-table-cell" style="white-space: normal; min-width: 500px;">
                        <div class="permission-tags-wrapper">
                            <?php
                                $permMap = [
                                    'settings' => ['icon' => 'mdi mdi-tune-vertical', 'class' => 'tag-core'],
                                    'roles' => ['icon' => 'mdi mdi-shield-account', 'class' => 'tag-security'],
                                    'admins' => ['icon' => 'ti-user', 'class' => 'tag-core'],
                                    'addresses' => ['icon' => 'mdi mdi-earth', 'class' => 'tag-logic'],
                                    'departments' => ['icon' => 'mdi mdi-office-building', 'class' => 'tag-logic'],
                                    'tasks' => ['icon' => 'mdi mdi-format-list-checks', 'class' => 'tag-logic'],
                                    'sliders' => ['icon' => 'mdi mdi-image-multiple', 'class' => 'tag-content'],
                                    'pages' => ['icon' => 'mdi mdi-file-document-outline', 'class' => 'tag-content'],
                                    'mailing' => ['icon' => 'mdi mdi-email-outline', 'class' => 'tag-comm'],
                                    'notifications' => ['icon' => 'mdi mdi-bell-outline', 'class' => 'tag-comm'],
                                ];
                            ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $pInfo = $permMap[$permName] ?? [
                                        'icon' => 'mdi mdi-check-circle-outline',
                                        'class' => 'tag-core',
                                    ];
                                ?>
                                <div class="premium-tag <?php echo e($pInfo['class']); ?>">
                                    <i class="<?php echo e($pInfo['icon']); ?>"></i>
                                    <?php echo e(__(config('global.permissions.' . $permName))); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </td>
                    <td class="text-end td-fit">
                        <?php echo $__env->make('dashboard.roles.parts.action', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>

                    
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div class="me-3 flex-shrink-0">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center border shadow-sm"
                                        style="width: 48px; height: 48px;">
                                        <i class="mdi mdi-shield-account text-primary fs-3"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                        <?php echo $role->role; ?>

                                    </h5>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-key-outline me-1"></i><?php echo __('roles.permissions'); ?>

                                        </label>
                                        <div class="permission-tags-wrapper">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $pInfo = $permMap[$permName] ?? [
                                                        'icon' => 'mdi mdi-check-circle-outline',
                                                        'class' => 'tag-core',
                                                    ];
                                                ?>
                                                <div class="premium-tag <?php echo e($pInfo['class']); ?>">
                                                    <i class="<?php echo e($pInfo['icon']); ?>"></i>
                                                    <?php echo e(__(config('global.permissions.' . $permName))); ?>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="11">
                        <?php if (isset($component)) { $__componentOriginal50f6691cb7e71446f1706a70a912a0e8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal50f6691cb7e71446f1706a70a912a0e8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.empty-state','data' => ['icon' => 'mdi-shield-off-outline','message' => __('roles.no_roles_found')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'mdi-shield-off-outline','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('roles.no_roles_found'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal50f6691cb7e71446f1706a70a912a0e8)): ?>
<?php $attributes = $__attributesOriginal50f6691cb7e71446f1706a70a912a0e8; ?>
<?php unset($__attributesOriginal50f6691cb7e71446f1706a70a912a0e8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal50f6691cb7e71446f1706a70a912a0e8)): ?>
<?php $component = $__componentOriginal50f6691cb7e71446f1706a70a912a0e8; ?>
<?php unset($__componentOriginal50f6691cb7e71446f1706a70a912a0e8); ?>
<?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
    <div class="mt-4 pagination-wrapper d-flex justify-content-end">
        <?php echo $roles->withQueryString()->links(); ?>

    </div>
</div>
<?php /**PATH C:\laragon\www\market\resources\views/dashboard/roles/partials/_table.blade.php ENDPATH**/ ?>