<div class="row g-4 mb-4">
    {{-- Monthly Sales Line Chart --}}
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title card-title-dash">{{ __('dashboard.monthly_sales') }}</h4>
                <div class="chart-container" style="position: relative; height:320px; display: flex; justify-content: center;">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Monthly Orders Bar Chart --}}
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title card-title-dash">{{ __('dashboard.monthly_orders') }}</h4>
                <div class="chart-container" style="position: relative; height:320px; display: flex; justify-content: center;">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- Best Selling Products Doughnut Chart --}}
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title card-title-dash">{{ __('dashboard.best_selling_products') }}</h4>
                <div class="chart-container" style="position: relative; height:320px; display: flex; justify-content: center;">
                    <canvas id="productsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Status Distribution Pie Chart --}}
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title card-title-dash">{{ __('dashboard.order_status_distribution') }}</h4>
                <div class="chart-container" style="position: relative; height:320px; display: flex; justify-content: center;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
