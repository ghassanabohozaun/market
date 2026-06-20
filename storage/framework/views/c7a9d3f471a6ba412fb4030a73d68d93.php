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
                                <li class="breadcrumb-item active" aria-current="page"><?php echo __('addresses.countries'); ?></li>
                            </ol>
                        </nav>
                        <div class="btn-wrapper mt-3 mt-sm-0">
                            <button type="button" class="btn btn-primary text-white me-0" data-bs-toggle="modal"
                                data-bs-target="#createCountryModal">
                                <i class="icon-plus"></i> <?php echo __('addresses.create_new_country'); ?>

                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $__env->make('dashboard.addresses.countries.partials._search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                            <div class="card card-rounded mt-1">
                                <div class="card-body">
                                    <h4 class="card-title mb-4 d-flex align-items-center">
                                        <span class="card-icon-premium me-3">
                                            <i class="mdi mdi-earth"></i>
                                        </span>
                                        <?php echo __('addresses.show_all_countries'); ?>

                                    </h4>
                                    <div class="table-loader-container" style="position: relative;">
                                        <div class="table-loader-overlay">
                                            <span class="premium-loader"></span>
                                        </div>
                                        <div id="table_data">
                                            <?php echo $__env->make('dashboard.addresses.countries.partials._table', [
                                                'countries' => $countries,
                                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

    <?php $__env->startPush('modals'); ?>
        <?php echo $__env->make('dashboard.addresses.countries.modals.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('dashboard.addresses.countries.modals.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('dashboard.addresses.countries.parts.countries_data', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('dashboard.addresses.countries.modals.flags_reference', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('dashboard.general.tr-details', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('scripts'); ?>
        <script type="text/javascript">
            $(document).ready(function() {
                // Initialize Generic Index Table Handler
                window.initIndexTable({
                    container: '#table_data',
                    loader: '.table-loader-overlay',
                    detailsModal: '#detailsModal',
                    detailsModalLabel: '#detailsModalLabel',
                    detailsModalBody: '#modalBody'
                });
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.dashboard.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\market\resources\views/dashboard/addresses/countries/index.blade.php ENDPATH**/ ?>