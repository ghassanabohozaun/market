<div class="table-responsive table-responsive-custom">
    <table class="table table-hover" id="responsiveTable">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-start">{!! __('addresses.city_name') !!}</th>
                <th class="text-start d-none d-md-table-cell">{!! __('addresses.governorate_name') !!}</th>
                <th class="text-center d-none d-lg-table-cell">{!! __('addresses.status') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('addresses.manage_status') !!}</th>
                <th class="text-center">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cities as $city)
                <tr id="row{{ $city->id }}">
                    <td class="details-col">
                        <i class="mdi mdi-plus-circle details-control" data-title="{!! $city->name !!}"></i>
                    </td>
                    <td class="text-start">{!! $loop->iteration !!}</td>
                    <td class="text-start">{!! $city->name !!}</td>
                    <td class="text-start d-none d-md-table-cell">{!! $city->governorate->name !!}</td>
                    <td class="text-center d-none d-lg-table-cell td-fit td-center-content">
                        @include('dashboard.addresses.cities.parts.status')
                    </td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.addresses.cities.parts.manage_status')
                    </td>
                    <td class="text-end td-fit">
                        @include('dashboard.addresses.cities.parts.actions')
                    </td>

                    {{-- Hidden content for Details Modal --}}
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center bg-light p-3 rounded-3 border">
                                <div class="me-3 flex-shrink-0">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center border shadow-sm"
                                         style="width: 48px; height: 48px;">
                                         <i class="mdi mdi-city-variant-outline text-primary fs-3"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                         {!! $city->name !!}
                                    </h5>
                                    <div class="d-flex align-items-center text-muted small">
                                         <span
                                             class="flag-icon flag-icon-{!! strtolower($city->governorate->country->flag_code ?? '') !!} me-2 shadow-sm rounded-1"
                                             style="width: 16px; height: 12px;"></span>
                                         <span>{!! $city->governorate->name !!} ({!! $city->governorate->country->name !!})</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-12">
                                    <div
                                        class="p-3 border rounded-3 bg-light shadow-sm d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center me-3 border shadow-sm"
                                                style="width: 36px; height: 36px;">
                                                <i class="mdi mdi-toggle-switch-outline text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <label class="small text-muted d-block text-uppercase fw-bold mb-0"
                                                    style="font-size: 0.7rem;">{!! __('addresses.status') !!}</label>
                                                <div class="mt-2 text-start px-0">
                                                    @include('dashboard.addresses.cities.parts.status')
                                                </div>
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
                        <x-dashboard.empty-state icon="mdi-earth-off" :message="__('addresses.no_cities_found')" />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4 pagination-wrapper d-flex justify-content-end">
    {!! $cities->withQueryString()->links() !!}
</div>
