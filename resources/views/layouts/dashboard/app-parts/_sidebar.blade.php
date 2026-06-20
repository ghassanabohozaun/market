<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">{{ __('dashboard.dashboard') }}</span>
            </a>
        </li>


        @canany(['settings', 'sliders', 'pages'])
            <li
                class="nav-item {{ request()->routeIs('dashboard.settings.*', 'dashboard.sliders.*', 'dashboard.pages.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#settings-menu"
                    aria-expanded="{{ request()->routeIs('dashboard.settings.*', 'dashboard.sliders.*', 'dashboard.pages.*') ? 'true' : 'false' }}"
                    aria-controls="settings-menu">
                    <i class="menu-icon mdi mdi-tune-vertical"></i>
                    <span class="menu-title">{!! __('dashboard.settings') !!}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ request()->routeIs('dashboard.settings.*', 'dashboard.sliders.*', 'dashboard.pages.*') ? 'show' : '' }}"
                    id="settings-menu">
                    <ul class="nav flex-column sub-menu">
                        @can('settings')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.settings.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.settings.index') }}">{!! __('settings.settings') !!}</a>
                            </li>
                        @endcan
                        @can('sliders')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.sliders.*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.sliders.index') }}">{!! __('sliders.sliders') !!}</a>
                            </li>
                        @endcan
                        @can('pages')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.pages.*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.pages.index') }}">{!! __('pages.pages') !!}</a>
                            </li>
                        @endcan

                    </ul>
                </div>
            </li>
        @endcanany

        @can('addresses')
            <li class="nav-item {{ request()->routeIs('dashboard.addresses.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#addresses-menu"
                    aria-expanded="{{ request()->routeIs('dashboard.addresses.*') ? 'true' : 'false' }}"
                    aria-controls="addresses-menu">
                    <i class="menu-icon mdi mdi-earth"></i>
                    <span class="menu-title">{!! __('dashboard.addresses') !!}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ request()->routeIs('dashboard.addresses.*') ? 'show' : '' }}" id="addresses-menu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.addresses.countries.index') ? 'active' : '' }}"
                                href="{{ route('dashboard.addresses.countries.index') }}">{!! __('addresses.countries') !!}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.addresses.governorates.index') ? 'active' : '' }}"
                                href="{{ route('dashboard.addresses.governorates.index') }}">{!! __('addresses.governorates') !!}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.addresses.cities.index') ? 'active' : '' }}"
                                href="{{ route('dashboard.addresses.cities.index') }}">{!! __('addresses.cities') !!}</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endcan


        @canany(['admins', 'roles'])
            <li class="nav-item {{ request()->routeIs('dashboard.admins.*') || request()->routeIs('dashboard.roles.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#admins-roles-menu"
                    aria-expanded="{{ request()->routeIs('dashboard.admins.*') || request()->routeIs('dashboard.roles.*') ? 'true' : 'false' }}"
                    aria-controls="admins-roles-menu">
                    <i class="menu-icon mdi mdi-account-key"></i>
                    <span class="menu-title">{!! __('admins.admins') !!}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ request()->routeIs('dashboard.admins.*') || request()->routeIs('dashboard.roles.*') ? 'show' : '' }}" id="admins-roles-menu">
                    <ul class="nav flex-column sub-menu">
                        @can('admins')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.admins.*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.admins.index') }}">{!! __('admins.admins') !!}</a>
                            </li>
                        @endcan

                        @can('roles')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.roles.*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.roles.index') }}">{{ __('roles.roles') }}</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        @can('categories')
            <li class="nav-item {{ request()->routeIs('dashboard.categories.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.categories.index') }}">
                    <i class="mdi mdi-shape-outline menu-icon"></i>
                    <span class="menu-title">{!! __('categories.categories') !!}</span>
                </a>
            </li>
        @endcan

        @can('tags')
            <li class="nav-item {{ request()->routeIs('dashboard.tags.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.tags.index') }}">
                    <i class="mdi mdi-tag-multiple-outline menu-icon"></i>
                    <span class="menu-title">{!! __('tags.tags') !!}</span>
                </a>
            </li>
        @endcan

        @can('testimonials')
            <li class="nav-item {{ request()->routeIs('dashboard.testimonials.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.testimonials.index') }}">
                    <i class="mdi mdi-account-star menu-icon"></i>
                    <span class="menu-title">{!! __('testimonials.testimonials') !!}</span>
                </a>
            </li>
        @endcan

        @can('tasks')
            <li class="nav-item {{ request()->routeIs('dashboard.tasks.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.tasks.index') }}">
                    <i class="mdi mdi-format-list-checks menu-icon"></i>
                    <span class="menu-title">{{ __('dashboard.tasks') }}</span>
                </a>
            </li>
        @endcan

    </ul>
</nav>
