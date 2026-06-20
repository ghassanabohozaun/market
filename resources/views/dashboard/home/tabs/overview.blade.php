<!-- begin: statistics -->
<div class="row g-4 mb-4">
    {{-- Sales Total --}}
    <div class="col-xl-3 col-lg-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box icon-soft-5 me-3 mb-0">
                    <i class="icon-wallet"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ number_format($stats['sales_total'], 2) }} {{ __('dashboard.currency') }}</div>
                    <div class="stat-label">{{ __('dashboard.sales_total') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Orders Count --}}
    <div class="col-xl-3 col-lg-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box icon-soft-1 me-3 mb-0">
                    <i class="icon-handbag"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $stats['orders_count'] }}</div>
                    <div class="stat-label">{{ __('dashboard.orders_count') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Products Count --}}
    <div class="col-xl-3 col-lg-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box icon-soft-2 me-3 mb-0">
                    <i class="icon-grid"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $stats['products_count'] }}</div>
                    <div class="stat-label">{{ __('dashboard.products_count') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Testimonials Count --}}
    <div class="col-xl-3 col-lg-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box icon-soft-3 me-3 mb-0">
                    <i class="icon-speech"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $stats['testimonials_count'] }}</div>
                    <div class="stat-label">{{ __('dashboard.testimonials_count') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- Categories Count --}}
    <div class="col-xl-3 col-lg-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box icon-soft-6 me-3 mb-0">
                    <i class="icon-list"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $stats['categories_count'] }}</div>
                    <div class="stat-label">{{ __('dashboard.categories_count') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Brands Count --}}
    <div class="col-xl-3 col-lg-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box icon-soft-4 me-3 mb-0">
                    <i class="icon-tag"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $stats['brands_count'] }}</div>
                    <div class="stat-label">{{ __('dashboard.brands_count') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Notifications Count --}}
    <div class="col-xl-3 col-lg-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box icon-soft-7 me-3 mb-0">
                    <i class="icon-bell"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $stats['notifications_count'] }}</div>
                    <div class="stat-label">{{ __('dashboard.notifications_count') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Messages/Contacts Count --}}
    <div class="col-xl-3 col-lg-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box icon-soft-8 me-3 mb-0">
                    <i class="icon-envelope"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $stats['contacts_count'] }}</div>
                    <div class="stat-label">{{ __('dashboard.contacts_count') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: statistics -->

<div class="row">
    {{-- Recent Orders Table --}}
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="card-title card-title-dash">{{ __('dashboard.recent_orders') }}</h4>
                    </div>
                    <div>
                        <a href="{{ route('dashboard.orders.index') }}" class="btn btn-primary btn-sm text-white">
                            <i class="mdi mdi-eye me-1"></i> {{ __('dashboard.view_all') }}
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-start">
                        <thead>
                            <tr>
                                <th>{{ __('dashboard.order_id') }}</th>
                                <th>{{ __('dashboard.customer') }}</th>
                                <th>{{ __('dashboard.total_price') }}</th>
                                <th>{{ __('dashboard.city') }}</th>
                                <th>{{ __('dashboard.status') }}</th>
                                <th>{{ __('dashboard.date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td>
                                        <span class="fw-bold text-primary">#{{ $order->id }}</span>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-bold">{{ $order->user_name }}</p>
                                        <small class="text-muted">{{ $order->user_phone }}</small>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ number_format($order->total_price, 2) }} {{ __('dashboard.currency') }}</span>
                                    </td>
                                    <td>{{ $order->city }}</td>
                                    <td>
                                        @php
                                            $badgeClass = 'badge-opacity-warning';
                                            $statusLabel = __('website.statusPending');
                                            
                                            if ($order->status == 'completed') {
                                                $badgeClass = 'badge-opacity-success';
                                                $statusLabel = __('orders.completed');
                                            } elseif ($order->status == 'delivered') {
                                                $badgeClass = 'badge-opacity-info';
                                                $statusLabel = __('website.statusDelivered');
                                            } elseif ($order->status == 'cancelled') {
                                                $badgeClass = 'badge-opacity-danger';
                                                $statusLabel = __('website.statusCancelled');
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }} d-inline-flex align-items-center">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td>
                                        <small>{{ $order->created_at->format('Y-m-d') }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
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

    {{-- Recent Messages --}}
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="card-title card-title-dash">{{ __('dashboard.recent_messages') }}</h4>
                    </div>
                    <div>
                        <a href="{{ route('dashboard.contacts.index') }}" class="btn btn-otline-dark btn-sm">
                            {{ __('dashboard.view_all') }}
                        </a>
                    </div>
                </div>
                <div class="list-wrapper">
                    <ul class="todo-list todo-list-rounded text-start" style="list-style: none; padding: 0;">
                        @forelse($recentContacts as $contact)
                            <li class="d-flex flex-column align-items-start py-3 border-bottom" style="border-bottom: 1px solid #edf2f7 !important;">
                                <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                    <span class="fw-bold text-dark" style="font-size: 0.85rem;">{{ $contact->name }}</span>
                                    <span class="badge {{ $contact->is_read ? 'badge-opacity-secondary' : 'badge-opacity-danger' }} small" style="font-size: 0.7rem;">
                                        {{ $contact->is_read ? __('dashboard.read') : __('dashboard.unread') }}
                                    </span>
                                </div>
                                <p class="mb-1 text-muted small text-truncate w-100" style="max-width: 250px;">
                                    <strong>{{ $contact->subject }}:</strong> {{ $contact->message }}
                                </p>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    <i class="icon-clock me-1"></i> {{ $contact->created_at }}
                                </small>
                            </li>
                        @empty
                            <li class="text-center text-muted py-4 w-100">
                                {{ __('dashboard.no_data') }}
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
