<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <!--  Logo   -->
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="<?php echo e(route('dashboard.index')); ?>">
                <img id="navbar_brand_logo" class="rounded" src="<?php echo setting()->logo
                    ? asset('uploads/settings/' . setting()->logo)
                    : asset('assets/dashboard/images/dokkana-logo.png'); ?>" alt="logo"
                    style="height: 60px; width: auto;">
            </a>
            <a class="navbar-brand brand-logo-mini" href="<?php echo e(route('dashboard.index')); ?>">
                <img id="navbar_brand_logo_mini" src="<?php echo setting()->logo
                    ? asset('uploads/settings/' . setting()->logo)
                    : asset('assets/dashboard/images/dokkana-logo.png'); ?>" alt="logo"
                    style="height: 70px; width: auto;">
            </a>
        </div>
    </div>
    <!-- End Logo   -->

    <!-- User Menu   -->
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <!-- User Welcome   -->
        <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text"><?php echo greeting(); ?>,
                    <span class="text-black fw-bold">
                        <?php echo admin()->user()->name; ?></span>
                </h1>
            </li>
        </ul>
        <!-- End User Welcome   -->


        <ul class="navbar-nav ms-auto">

            <!-- User Date picker   -->
            <li class="nav-item d-none d-lg-block">
                <div id="datepicker-popup"
                    class="input-group date datepicker navbar-date-picker navbar-date-picker-premium">
                    <span class="input-group-addon input-group-prepend">
                        <span class="icon-calendar input-group-text calendar-icon"></span>
                    </span>
                    <input type="text" class="form-control" value="<?php echo e(date('m/d/Y')); ?>">
                </div>
            </li>
            <!-- End User Date picker   -->

            <!-- User language   -->
            <li class="nav-item d-none d-lg-block">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('dashboard.global-search');

$key = null;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3826644449-0', null);

$__html = app('livewire')->mount($__name, $__params, $key);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </li>
            <?php
                $currentLocale = Lang();
                $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
                $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
            ?>
            <li class="nav-item">
                <a href="<?php echo e(LaravelLocalization::getLocalizedURL($targetLocale, null, [], true)); ?>"
                    class="nav-link p-0 d-flex align-items-center h-100">
                    <div class="language-switcher-premium">
                        <span class="flag-icon flag-icon-<?php echo strtolower($targetLocale == 'ar' ? 'sa' : 'us'); ?> shadow-sm"></span>
                        <span class="lang-name"><?php echo e($targetNative); ?></span>
                    </div>
                </a>
            </li>
            <!-- End User language   -->

            <!-- User notifications -->
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('dashboard.notifications');

$key = null;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3826644449-1', null);

$__html = app('livewire')->mount($__name, $__params, $key);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <!-- End User notifications -->

            <!-- User messages     -->
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator position-relative" id="countDropdown" href="#"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="icon-mail icon-lg"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0 shadow-sm border-0"
                    aria-labelledby="countDropdown" style="min-width: 320px;">
                    <div class="dropdown-item py-3 border-bottom d-flex justify-content-between align-items-center">
                        <p class="mb-0 fw-medium text-dark" style="font-size: 0.8rem;">
                            <?php echo e(__('navbar.unread_mails_summary', ['count' => 0])); ?></p>
                        <span class="badge badge-pill badge-primary"
                            style="cursor: pointer; font-size: 0.65rem;"><?php echo e(__('navbar.view_all')); ?></span>
                    </div>

                    <div style="max-height: 350px; overflow-y: auto;">
                        <div class="dropdown-item preview-item py-4 border-bottom">
                            <div class="preview-item-content text-center w-100">
                                <p class="fw-medium mb-0 text-muted" style="font-size: 0.75rem;">
                                    <?php echo e(__('navbar.no_new_messages')); ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <!-- End User messages -->

            <!-- User Dropdown -->
            <li class="nav-item dropdown user-dropdown user-dropdown-premium">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle header_admin_photo shadow-sm border" src="<?php echo admin()->user()->photo
                        ? asset('uploads/adminsPhotos/' . admin()->user()->photo)
                        : asset('assets/dashboard/images/faces/avatar-male.jpg'); ?>"
                        alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown animated fadeIn"
                    aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center pb-3">
                        <div class="position-relative d-inline-block">
                            <img class="img-md rounded-circle header_admin_photo mb-2" src="<?php echo admin()->user()->photo
                                ? asset('uploads/adminsPhotos/' . admin()->user()->photo)
                                : asset('assets/dashboard/images/faces/avatar-male.jpg'); ?>"
                                alt="Profile image"
                                style="width: 70px; height: 70px; object-fit: cover; border: 3px solid #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        </div>
                        <p class="mb-0 mt-2 fw-bold text-dark header_admin_name" style="font-size: 0.95rem;">
                            <?php echo admin()->user()->name; ?></p>
                        <p class="fw-medium text-muted mb-0 header_admin_email small"><?php echo admin()->user()->email; ?></p>
                    </div>


                    <a class="dropdown-item py-2" href="<?php echo e(route('dashboard.profile.index')); ?>">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span><?php echo e(__('navbar.my_profile')); ?></span>
                    </a>

                    <a class="dropdown-item py-2" href="<?php echo route('dashboard.lock.screen'); ?>">
                        <i class="mdi mdi-lock-reset"></i>
                        <span><?php echo e(__('auth.lock_screen')); ?></span>
                    </a>

                    <a class="dropdown-item py-2 text-danger" href="<?php echo route('dashboard.logout'); ?>">
                        <i class="mdi mdi-logout-variant"></i>
                        <span><?php echo e(__('auth.logout')); ?></span>
                    </a>
                </div>
            </li>
            <!-- End User Dropdown -->


        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<?php /**PATH C:\laragon\www\market\resources\views/layouts/dashboard/app-parts/_navbar.blade.php ENDPATH**/ ?>