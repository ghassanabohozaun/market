<div class="row g-4 mb-4">
    {{-- Average Order Value Card --}}
    <div class="col-md-6">
        <div class="card stat-card" style="background: linear-gradient(135deg, #1F3BB3 0%, #0d258f 100%); color: #fff; border: none;">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <h3 class="fw-bold mb-1 text-white" style="font-size: 2rem;">{{ number_format($averageOrderValue, 2) }} {{ __('dashboard.currency') }}</h3>
                    <p class="mb-0 text-white-50 fw-bold" style="font-size: 0.9rem;">{{ __('dashboard.average_order_value') }}</p>
                </div>
                <div class="icon-box bg-white-50 text-white mb-0" style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255, 255, 255, 0.15);">
                    <i class="icon-chart" style="font-size: 1.5rem !important;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Top Ordering City Card --}}
    <div class="col-md-6">
        <div class="card stat-card" style="background: linear-gradient(135deg, #52CDFF 0%, #00a4eb 100%); color: #fff; border: none;">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    @php
                        $topGov = $governorateOrders->first();
                    @endphp
                    <h3 class="fw-bold mb-1 text-white" style="font-size: 2rem;">{{ $topGov ? $topGov->governorate : __('dashboard.no_data') }}</h3>
                    <p class="mb-0 text-white-50 fw-bold" style="font-size: 0.9rem;">{{ __('dashboard.orders_by_governorate') }}</p>
                </div>
                <div class="icon-box bg-white-50 text-white mb-0" style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255, 255, 255, 0.15);">
                    <i class="icon-location" style="font-size: 1.5rem !important;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Top Selling Products Details Table --}}
    <div class="col-lg-7 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title card-title-dash mb-4">{{ __('dashboard.top_products_table') }}</h4>
                <div class="table-responsive">
                    <table class="table table-hover text-start">
                        <thead>
                            <tr>
                                <th>{{ __('dashboard.product_name') }}</th>
                                <th>{{ __('dashboard.quantity_sold') }}</th>
                                <th>{{ __('dashboard.revenue') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topProducts as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->product ? $item->product->first_image_path : asset('assets/website/images/prod1.png') }}" 
                                                 alt="{{ $item->product_name }}" 
                                                 class="rounded me-3" 
                                                 style="width: 45px; height: 45px; object-fit: cover;">
                                            <div>
                                                <p class="mb-0 fw-bold text-start">{{ $item->product_name }}</p>
                                                <p class="mb-0 text-muted small text-start">{{ $item->product && $item->product->category ? $item->product->category->name : '' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-opacity-success fw-bold">{{ $item->total_qty }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ number_format($item->total_revenue, 2) }} {{ __('dashboard.currency') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        {{ __('dashboard.no_data') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- City Distribution and Wishlists --}}
    <div class="col-lg-5 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                {{-- Orders by Governorate --}}
                <h4 class="card-title card-title-dash mb-3">{{ __('dashboard.orders_by_governorate') }}</h4>
                <div class="mb-4">
                    @php
                        $maxOrders = $governorateOrders->first()->count ?? 1;
                    @endphp
                    @forelse($governorateOrders as $gov)
                        @php
                            $percentage = round(($gov->count / $maxOrders) * 100);
                        @endphp
                        <div class="mb-3 text-start">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small fw-bold">{{ $gov->governorate }}</span>
                                <span class="small text-muted">{{ __('dashboard.orders_count') }}: {{ $gov->count }} ({{ number_format($gov->total_sales, 2) }} {{ __('dashboard.currency') }})</span>
                            </div>
                            <div class="progress progress-sm" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted small py-3">{{ __('dashboard.no_data') }}</p>
                    @endforelse
                </div>

                <hr class="my-4" style="border-color: #edf2f7;">

                {{-- Most Wishlisted Products --}}
                <h4 class="card-title card-title-dash mb-3">{{ __('dashboard.most_wishlisted_products') }}</h4>
                <div class="list-wrapper">
                    <ul class="todo-list todo-list-rounded text-start" style="list-style: none; padding: 0;">
                        @forelse($mostWishlisted as $item)
                            <li class="d-flex align-items-center py-2 border-bottom" style="border-bottom: 1px solid #edf2f7 !important;">
                                <img src="{{ $item->product ? $item->product->first_image_path : asset('assets/website/images/prod1.png') }}" 
                                     alt="" 
                                     class="rounded me-3" 
                                     style="width: 40px; height: 40px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-bold text-dark text-start" style="font-size: 0.85rem;">{{ $item->product ? $item->product->name : 'N/A' }}</p>
                                    <small class="text-muted small text-start d-block" style="font-size: 0.75rem;">
                                        {{ $item->product && $item->product->brand ? $item->product->brand->name : '' }}
                                    </small>
                                </div>
                                <span class="badge badge-opacity-danger small d-inline-flex align-items-center">
                                    <i class="mdi mdi-heart me-1"></i> {{ $item->count }}
                                </span>
                            </li>
                        @empty
                            <li class="text-center text-muted py-3 w-100">
                                {{ __('dashboard.no_data') }}
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
