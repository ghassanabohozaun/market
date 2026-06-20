<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item <?php echo e(request()->routeIs('dashboard.index') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('dashboard.index')); ?>">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title"><?php echo e(__('dashboard.dashboard')); ?></span>
            </a>
        </li>


        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['settings', 'sliders', 'pages'])): ?>
            <li
                class="nav-item <?php echo e(request()->routeIs('dashboard.settings.*', 'dashboard.sliders.*', 'dashboard.pages.*') ? 'active' : ''); ?>">
                <a class="nav-link" data-bs-toggle="collapse" href="#settings-menu"
                    aria-expanded="<?php echo e(request()->routeIs('dashboard.settings.*', 'dashboard.sliders.*', 'dashboard.pages.*') ? 'true' : 'false'); ?>"
                    aria-controls="settings-menu">
                    <i class="menu-icon mdi mdi-tune-vertical"></i>
                    <span class="menu-title"><?php echo __('dashboard.settings'); ?></span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse <?php echo e(request()->routeIs('dashboard.settings.*', 'dashboard.sliders.*', 'dashboard.pages.*') ? 'show' : ''); ?>"
                    id="settings-menu">
                    <ul class="nav flex-column sub-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('dashboard.settings.index') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('dashboard.settings.index')); ?>"><?php echo __('settings.settings'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sliders')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('dashboard.sliders.*') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('dashboard.sliders.index')); ?>"><?php echo __('sliders.sliders'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pages')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('dashboard.pages.*') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('dashboard.pages.index')); ?>"><?php echo __('pages.pages'); ?></a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('addresses')): ?>
            <li class="nav-item <?php echo e(request()->routeIs('dashboard.addresses.*') ? 'active' : ''); ?>">
                <a class="nav-link" data-bs-toggle="collapse" href="#addresses-menu"
                    aria-expanded="<?php echo e(request()->routeIs('dashboard.addresses.*') ? 'true' : 'false'); ?>"
                    aria-controls="addresses-menu">
                    <i class="menu-icon mdi mdi-earth"></i>
                    <span class="menu-title"><?php echo __('dashboard.addresses'); ?></span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse <?php echo e(request()->routeIs('dashboard.addresses.*') ? 'show' : ''); ?>" id="addresses-menu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.addresses.countries.index') ? 'active' : ''); ?>"
                                href="<?php echo e(route('dashboard.addresses.countries.index')); ?>"><?php echo __('addresses.countries'); ?></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.addresses.governorates.index') ? 'active' : ''); ?>"
                                href="<?php echo e(route('dashboard.addresses.governorates.index')); ?>"><?php echo __('addresses.governorates'); ?></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.addresses.cities.index') ? 'active' : ''); ?>"
                                href="<?php echo e(route('dashboard.addresses.cities.index')); ?>"><?php echo __('addresses.cities'); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>


        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['admins', 'roles'])): ?>
            <li class="nav-item <?php echo e(request()->routeIs('dashboard.admins.*') || request()->routeIs('dashboard.roles.*') ? 'active' : ''); ?>">
                <a class="nav-link" data-bs-toggle="collapse" href="#admins-roles-menu"
                    aria-expanded="<?php echo e(request()->routeIs('dashboard.admins.*') || request()->routeIs('dashboard.roles.*') ? 'true' : 'false'); ?>"
                    aria-controls="admins-roles-menu">
                    <i class="menu-icon mdi mdi-account-key"></i>
                    <span class="menu-title"><?php echo __('admins.admins'); ?></span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse <?php echo e(request()->routeIs('dashboard.admins.*') || request()->routeIs('dashboard.roles.*') ? 'show' : ''); ?>" id="admins-roles-menu">
                    <ul class="nav flex-column sub-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admins')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('dashboard.admins.*') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('dashboard.admins.index')); ?>"><?php echo __('admins.admins'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('dashboard.roles.*') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('dashboard.roles.index')); ?>"><?php echo e(__('roles.roles')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('categories')): ?>
            <li class="nav-item <?php echo e(request()->routeIs('dashboard.categories.*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('dashboard.categories.index')); ?>">
                    <i class="mdi mdi-shape-outline menu-icon"></i>
                    <span class="menu-title"><?php echo __('categories.categories'); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tags')): ?>
            <li class="nav-item <?php echo e(request()->routeIs('dashboard.tags.*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('dashboard.tags.index')); ?>">
                    <i class="mdi mdi-tag-multiple-outline menu-icon"></i>
                    <span class="menu-title"><?php echo __('tags.tags'); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('testimonials')): ?>
            <li class="nav-item <?php echo e(request()->routeIs('dashboard.testimonials.*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('dashboard.testimonials.index')); ?>">
                    <i class="mdi mdi-account-star menu-icon"></i>
                    <span class="menu-title"><?php echo __('testimonials.testimonials'); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tasks')): ?>
            <li class="nav-item <?php echo e(request()->routeIs('dashboard.tasks.*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('dashboard.tasks.index')); ?>">
                    <i class="mdi mdi-format-list-checks menu-icon"></i>
                    <span class="menu-title"><?php echo e(__('dashboard.tasks')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('market')): ?>
            <li class="nav-item <?php echo e(request()->routeIs('dashboard.market.*') ? 'active' : ''); ?>">
                <a class="nav-link" data-bs-toggle="collapse" href="#market-menu"
                    aria-expanded="<?php echo e(request()->routeIs('dashboard.market.*') ? 'true' : 'false'); ?>"
                    aria-controls="market-menu">
                    <i class="menu-icon mdi mdi-store"></i>
                    <span class="menu-title"><?php echo __('market.store_notebook'); ?></span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse <?php echo e(request()->routeIs('dashboard.market.*') ? 'show' : ''); ?>" id="market-menu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.market.customers.index') ? 'active' : ''); ?>"
                                href="<?php echo e(route('dashboard.market.customers.index')); ?>"><?php echo __('market.customers'); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

    </ul>
</nav>
<?php /**PATH C:\laragon\www\market\resources\views/layouts/dashboard/app-parts/_sidebar.blade.php ENDPATH**/ ?>