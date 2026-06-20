<div class="table-responsive table-responsive-custom">
    <table class="table table-hover" id="responsiveTable">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-start">{!! __('market.customer_name') !!}</th>
                <th class="text-start d-none d-md-table-cell">{!! __('market.phone') !!}</th>
                <th class="text-start d-none d-md-table-cell">{!! __('market.balance') !!}</th>
                <th class="text-start d-none d-md-table-cell">{!! __('market.total_transactions') !!}</th>
                <th class="text-center">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($market_customers as $market_customer)
                <tr class="row_{!! $market_customer->id !!}">
                    <td class="details-col">
                        <i class="mdi mdi-plus-circle details-control" data-title="{!! $market_customer->name !!}"></i>
                    </td>
                    <td class="text-start">{!! $loop->iteration !!}</td>
                    <td class="text-start">
                        {!! $market_customer->name !!}
                    </td>
                    <td class="text-start d-none d-md-table-cell">
                        <div dir="ltr" class="text-end" style="width: fit-content;">
                            {!! $market_customer->phone ?: '-' !!}
                        </div>
                    </td>
                    <td class="text-start d-none d-md-table-cell">
                        <div class="badge {!! $market_customer->balance < 0 ? 'badge-opacity-danger' : ($market_customer->balance > 0 ? 'badge-opacity-success' : 'badge-opacity-secondary') !!} rounded-pill fw-bold px-3 py-1">
                            {!! number_format($market_customer->balance, 1) !!}
                        </div>
                    </td>
                    <td class="text-start d-none d-md-table-cell">
                        <div class="badge badge-opacity-info rounded-pill fw-bold px-3 py-1">
                            {!! $market_customer->transactions_count !!}
                        </div>
                    </td>
                    <td class="text-end td-fit">
                        @include('dashboard.market_customers.parts.actions')
                    </td>

                    {{-- Hidden content for Details Modal --}}
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div class="me-3 flex-shrink-0">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center border shadow-sm"
                                        style="width: 48px; height: 48px;">
                                        <i class="mdi mdi-account-circle text-primary" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                        {!! $market_customer->name !!}
                                    </h5>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-phone-classic me-1"></i>{!! __('market.phone') !!}
                                        </label>
                                        <div class="mt-1" dir="ltr" style="text-align: right;">
                                            {!! $market_customer->phone ?: '-' !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-cash-multiple me-1"></i>{!! __('market.balance') !!}
                                        </label>
                                        <div class="mt-1">
                                            <div class="badge {!! $market_customer->balance < 0 ? 'badge-opacity-danger' : ($market_customer->balance > 0 ? 'badge-opacity-success' : 'badge-opacity-secondary') !!} rounded-pill fw-bold px-3 py-1">
                                                {!! number_format($market_customer->balance, 1) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-format-list-bulleted me-1"></i>{!! __('market.total_transactions') !!}
                                        </label>
                                        <div class="mt-1">
                                            <div class="badge badge-opacity-info rounded-pill fw-bold px-3 py-1">
                                                {!! $market_customer->transactions_count !!}
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
                    <td colspan="7">
                        <x-dashboard.empty-state icon="mdi-account-off" :message="__('market.no_customers_added')" />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4 pagination-wrapper d-flex justify-content-end">
    {!! $market_customers->withQueryString()->links() !!}
</div>
