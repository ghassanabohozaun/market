<div class="table-responsive table-responsive-custom">
    <table class="table table-hover" id="responsiveTable">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-start"><?php echo __('addresses.country_name'); ?></th>
                <th class="text-start d-none d-md-table-cell"><?php echo __('addresses.phone_code'); ?></th>
                <th class="text-start d-none d-md-table-cell"><?php echo __('addresses.governorates_count'); ?></th>
                <th class="text-start d-none d-md-table-cell"><?php echo __('addresses.cities_count'); ?></th>
                <th class="text-center d-none d-lg-table-cell"><?php echo __('addresses.status'); ?></th>
                <th class="text-center d-none d-xl-table-cell"><?php echo __('addresses.manage_status'); ?></th>
                <th class="text-center"><?php echo __('general.actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="row_<?php echo $country->id; ?>">
                    <td class="details-col">
                        <i class="mdi mdi-plus-circle details-control" data-title="<?php echo $country->name; ?>"></i>
                    </td>
                    <td class="text-start"><?php echo $loop->iteration; ?></td>
                    <td class="text-start">
                        <span class="flag-icon flag-icon-<?php echo strtolower($country->flag_code); ?> me-2 shadow-sm rounded-1"
                            style="width: 20px; height: 15px;"></span>
                        <?php echo $country->name; ?>

                    </td>
                    <td class="text-start d-none d-md-table-cell">
                        <?php echo $__env->make('dashboard.addresses.countries.parts.phone_code', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                    <td class="text-start d-none d-md-table-cell">
                        <div class="badge badge-opacity-warning rounded-pill fw-bold px-3 py-1">
                            <?php echo $country->governorates_count; ?>

                        </div>
                    </td>
                    <td class="text-start d-none d-md-table-cell">
                        <?php echo $__env->make('dashboard.addresses.countries.parts.cities_count', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                    <td class="text-center d-none d-lg-table-cell td-fit td-center-content">
                        <?php echo $__env->make('dashboard.addresses.countries.parts.status', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        <?php echo $__env->make('dashboard.addresses.countries.parts.manage_status', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                    <td class="text-end td-fit">
                        <?php echo $__env->make('dashboard.addresses.countries.parts.actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>

                    
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div class="me-3 flex-shrink-0">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center border shadow-sm"
                                        style="width: 48px; height: 48px;">
                                        <span class="flag-icon flag-icon-<?php echo strtolower($country->flag_code); ?> rounded-1"
                                            style="font-size: 1.5rem;"></span>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                        <?php echo $country->name; ?>

                                    </h5>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-phone-classic me-1"></i><?php echo __('addresses.phone_code'); ?>

                                        </label>
                                        <div class="mt-1">
                                            <?php echo $__env->make('dashboard.addresses.countries.parts.phone_code', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-office-building me-1"></i><?php echo __('addresses.governorates_count'); ?>

                                        </label>
                                        <div class="mt-1">
                                            <div class="badge badge-opacity-warning rounded-pill fw-bold px-3 py-1">
                                                <?php echo $country->governorates_count; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-city-variant-outline me-1"></i><?php echo __('addresses.cities_count'); ?>

                                        </label>
                                        <div class="mt-1">
                                            <?php echo $__env->make('dashboard.addresses.countries.parts.cities_count', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div
                                        class="p-3 border rounded-3 bg-light shadow-sm d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center me-3 border shadow-sm"
                                                style="width: 36px; height: 36px;">
                                                <i class="mdi mdi-toggle-switch-outline text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <label class="small text-muted d-block text-uppercase fw-bold mb-0"
                                                    style="font-size: 0.7rem;"><?php echo __('addresses.status'); ?></label>
                                                <div class="mt-2 text-start px-0">
                                                    <?php echo $__env->make('dashboard.addresses.countries.parts.status', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                                </div>
                                            </div>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.empty-state','data' => ['icon' => 'mdi-earth-off','message' => __('addresses.no_countries_found')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'mdi-earth-off','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('addresses.no_countries_found'))]); ?>
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
</div>
<div class="mt-4 pagination-wrapper d-flex justify-content-end">
    <?php echo $countries->withQueryString()->links(); ?>

</div>
<?php /**PATH C:\laragon\www\market\resources\views/dashboard/addresses/countries/partials/_table.blade.php ENDPATH**/ ?>