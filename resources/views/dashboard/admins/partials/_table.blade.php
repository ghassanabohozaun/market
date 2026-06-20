<div class="table-responsive table-responsive-custom">
    <table class="table table-hover" id="responsiveTable">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-start">{!! __('admins.name') !!}</th>
                <th class="text-start d-none d-md-table-cell">{!! __('admins.email') !!}</th>
                <th class="text-start d-none d-lg-table-cell">{!! __('admins.role_id') !!}</th>
                <th class="text-start d-none d-xl-table-cell">{!! __('admins.created_at') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('admins.status') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('admins.manage_status') !!}</th>
                <th class="text-center">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($admins as $admin)
                <tr id="row{{ $admin->id }}">
                    <td class="details-col"><i class="mdi mdi-plus-circle details-control"
                            data-title="{!! $admin->name !!}"></i>
                    </td>
                    <td class="text-start">{!! $loop->iteration !!}</td>
                    <td class="text-start">{!! $admin->name !!}</td>
                    <td class="text-start d-none d-md-table-cell">{!! $admin->email !!}</td>
                    <td class="text-start d-none d-lg-table-cell">{!! $admin->role->role ?? 'N/A' !!}</td>
                    <td class="text-start d-none d-xl-table-cell">{!! $admin->created_at !!}</td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.admins.parts.status')
                    </td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.admins.parts.manage_status')
                    </td>
                    <td class="text-end td-fit">
                        @include('dashboard.admins.parts.actions', [
                            'admin' => $admin,
                        ])
                    </td>

                    {{-- Hidden content for Details Modal --}}
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div class="me-3 flex-shrink-0">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center border shadow-sm"
                                        style="width: 48px; height: 48px; overflow: hidden;">
                                        @include('dashboard.admins.parts.photo', ['admin' => $admin])
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                        {!! $admin->name !!}
                                    </h5>
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="mdi mdi-email-outline me-1"></i>
                                        <span>{!! $admin->email !!}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-shield-account-outline me-1"></i>{!! __('admins.role_id') !!}
                                        </label>
                                        <span
                                            class="badge badge-opacity-primary rounded-pill px-3 py-2 fw-bold d-inline-flex align-items-center"
                                            style="font-size: 0.85rem;">
                                            {{ $admin->role->role ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-toggle-switch-outline me-1"></i>{!! __('admins.status') !!}
                                        </label>
                                        <div>
                                            @include('dashboard.admins.parts.status')
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div
                                        class="p-3 border rounded-3 bg-light shadow-sm d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center me-3 border shadow-sm"
                                                style="width: 36px; height: 36px;">
                                                <i class="mdi mdi-calendar-clock text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <label class="small text-muted d-block text-uppercase fw-bold mb-0"
                                                    style="font-size: 0.7rem;">{!! __('admins.created_at') !!}</label>
                                                <span class="fw-medium text-dark">{!! $admin->created_at !!}</span>
                                            </div>
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
                        <x-dashboard.empty-state icon="mdi-account-off-outline" :message="__('admins.no_admins_found')" />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4 pagination-wrapper d-flex justify-content-end">
    {!! $admins->withQueryString()->links() !!}
</div>
