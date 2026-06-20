<div class="table-responsive table-responsive-custom">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-start">{!! __('roles.role_name') !!}</th>
                <th class="text-start d-none d-md-table-cell">{!! __('roles.permissions') !!}</th>
                <th class="text-center">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td class="details-col">
                        <i class="mdi mdi-plus-circle details-control" data-title="{!! $role->role !!}"></i>
                    </td>
                    <td class="text-start">{!! $loop->iteration !!}</td>
                    <td class="text-start">{!! $role->role !!}</td>
                    <td class="text-start d-none d-md-table-cell" style="white-space: normal; min-width: 500px;">
                        <div class="permission-tags-wrapper">
                            @php
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
                            @endphp
                            @foreach ($role->permissions as $permName)
                                @php
                                    $pInfo = $permMap[$permName] ?? [
                                        'icon' => 'mdi mdi-check-circle-outline',
                                        'class' => 'tag-core',
                                    ];
                                @endphp
                                <div class="premium-tag {{ $pInfo['class'] }}">
                                    <i class="{{ $pInfo['icon'] }}"></i>
                                    {{ __(config('global.permissions.' . $permName)) }}
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-end td-fit">
                        @include('dashboard.roles.parts.action')
                    </td>

                    {{-- Hidden content for Details Modal --}}
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
                                        {!! $role->role !!}
                                    </h5>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-key-outline me-1"></i>{!! __('roles.permissions') !!}
                                        </label>
                                        <div class="permission-tags-wrapper">
                                            @foreach ($role->permissions as $permName)
                                                @php
                                                    $pInfo = $permMap[$permName] ?? [
                                                        'icon' => 'mdi mdi-check-circle-outline',
                                                        'class' => 'tag-core',
                                                    ];
                                                @endphp
                                                <div class="premium-tag {{ $pInfo['class'] }}">
                                                    <i class="{{ $pInfo['icon'] }}"></i>
                                                    {{ __(config('global.permissions.' . $permName)) }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">
                        <x-dashboard.empty-state icon="mdi-shield-off-outline" :message="__('roles.no_roles_found')" />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4 pagination-wrapper d-flex justify-content-end">
        {!! $roles->withQueryString()->links() !!}
    </div>
</div>
