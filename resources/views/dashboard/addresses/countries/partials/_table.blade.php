<div class="table-responsive table-responsive-custom">
    <table class="table table-hover" id="responsiveTable">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-start">{!! __('addresses.country_name') !!}</th>
                <th class="text-start d-none d-md-table-cell">{!! __('addresses.phone_code') !!}</th>
                <th class="text-start d-none d-md-table-cell">{!! __('addresses.governorates_count') !!}</th>
                <th class="text-start d-none d-md-table-cell">{!! __('addresses.cities_count') !!}</th>
                <th class="text-center d-none d-lg-table-cell">{!! __('addresses.status') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('addresses.manage_status') !!}</th>
                <th class="text-center">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($countries as $country)
                <tr class="row_{!! $country->id !!}">
                    <td class="details-col">
                        <i class="mdi mdi-plus-circle details-control" data-title="{!! $country->name !!}"></i>
                    </td>
                    <td class="text-start">{!! $loop->iteration !!}</td>
                    <td class="text-start">
                        <span class="flag-icon flag-icon-{!! strtolower($country->flag_code) !!} me-2 shadow-sm rounded-1"
                            style="width: 20px; height: 15px;"></span>
                        {!! $country->name !!}
                    </td>
                    <td class="text-start d-none d-md-table-cell">
                        @include('dashboard.addresses.countries.parts.phone_code')
                    </td>
                    <td class="text-start d-none d-md-table-cell">
                        <div class="badge badge-opacity-warning rounded-pill fw-bold px-3 py-1">
                            {!! $country->governorates_count !!}
                        </div>
                    </td>
                    <td class="text-start d-none d-md-table-cell">
                        @include('dashboard.addresses.countries.parts.cities_count')
                    </td>
                    <td class="text-center d-none d-lg-table-cell td-fit td-center-content">
                        @include('dashboard.addresses.countries.parts.status')
                    </td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.addresses.countries.parts.manage_status')
                    </td>
                    <td class="text-end td-fit">
                        @include('dashboard.addresses.countries.parts.actions')
                    </td>

                    {{-- Hidden content for Details Modal --}}
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div class="me-3 flex-shrink-0">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center border shadow-sm"
                                        style="width: 48px; height: 48px;">
                                        <span class="flag-icon flag-icon-{!! strtolower($country->flag_code) !!} rounded-1"
                                            style="font-size: 1.5rem;"></span>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                        {!! $country->name !!}
                                    </h5>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-phone-classic me-1"></i>{!! __('addresses.phone_code') !!}
                                        </label>
                                        <div class="mt-1">
                                            @include('dashboard.addresses.countries.parts.phone_code')
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-office-building me-1"></i>{!! __('addresses.governorates_count') !!}
                                        </label>
                                        <div class="mt-1">
                                            <div class="badge badge-opacity-warning rounded-pill fw-bold px-3 py-1">
                                                {!! $country->governorates_count !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-city-variant-outline me-1"></i>{!! __('addresses.cities_count') !!}
                                        </label>
                                        <div class="mt-1">
                                            @include('dashboard.addresses.countries.parts.cities_count')
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
                                                    style="font-size: 0.7rem;">{!! __('addresses.status') !!}</label>
                                                <div class="mt-2 text-start px-0">
                                                    @include('dashboard.addresses.countries.parts.status')
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
                        <x-dashboard.empty-state icon="mdi-earth-off" :message="__('addresses.no_countries_found')" />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4 pagination-wrapper d-flex justify-content-end">
    {!! $countries->withQueryString()->links() !!}
</div>
