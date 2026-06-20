@push('css')
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/select2/select2.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/dashboard/css/filter.css') !!}">
@endpush

<div class="query-bar-container">
    <div class="query-bar js-query-bar">
        <span class="query-bar-label">
            <i class="mdi mdi-magnify"></i> {!! __('general.search') !!}:
        </span>

        <form class="js-filter-form d-flex align-items-center gap-2">
            <!-- Search Term Chip -->
            <div class="filter-chip js-filter-chip" data-target="search_popover">
                <i class="mdi mdi-account-search-outline"></i>
                <span class="chip-text">{!! __('general.search') !!}</span>
                <div class="filter-popover" id="search_popover">
                    <div class="mb-3 theme-primary">
                        <label class="form-label d-block fw-bold mb-1">{!! __('general.search') !!}</label>
                        <div class="input-group-premium">
                            <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                            <input type="text" class="form-control" name="search_term"
                                placeholder="{!! __('admins.search_placeholder') !!}">
                        </div>
                    </div>
                    <div class="popover-actions">
                        <button type="button"
                            class="btn btn-primary btn-sm text-white js-apply-filter">{!! __('general.apply') !!}</button>
                    </div>
                </div>
            </div>

            <!-- Role Filter Chip -->
            <div class="filter-chip js-filter-chip" data-target="role_popover">
                <i class="mdi mdi-shield-account-outline"></i>
                <span class="chip-text">{!! __('admins.role') !!}</span>
                <div class="filter-popover" id="role_popover">
                    <div class="mb-3 theme-info">
                        <label class="form-label d-block fw-bold mb-1">{!! __('admins.role') !!}</label>
                        <div class="input-group-premium select2-premium">
                            <span class="input-group-text"><i class="mdi mdi-security"></i></span>
                            <select class="form-control" name="role_id" style="width: 100%">
                                <option value="">{!! __('general.all') !!}</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="popover-actions">
                        <button type="button"
                            class="btn btn-primary btn-sm text-white js-apply-filter">{!! __('general.apply') !!}</button>
                    </div>
                </div>
            </div>

            <!-- Status Chip -->
            <div class="filter-chip js-filter-chip" data-target="status_popover">
                <i class="mdi mdi-toggle-switch-outline"></i>
                <span class="chip-text">{!! __('admins.status') !!}</span>
                <div class="filter-popover" id="status_popover">
                    <div class="mb-3 theme-warning">
                        <label class="form-label d-block fw-bold mb-1">{!! __('admins.status') !!}</label>
                        <div class="input-group-premium">
                            <span class="input-group-text"><i class="mdi mdi-check-circle-outline"></i></span>
                            <select class="form-control" name="status">
                                <option value="">{!! __('general.all') !!}</option>
                                <option value="1">{!! __('general.enable') !!}</option>
                                <option value="0">{!! __('general.disabled') !!}</option>
                            </select>
                        </div>
                    </div>
                    <div class="popover-actions">
                        <button type="button"
                            class="btn btn-primary btn-sm text-white js-apply-filter">{!! __('general.apply') !!}</button>
                    </div>
                </div>
            </div>

            <!-- Reset Button -->
            <div class="filter-chip reset-chip js-reset-btn">
                <i class="mdi mdi-refresh"></i>
                <span>{!! __('general.reset') !!}</span>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script src="{!! asset('assets/dashboard/vendors/select2/select2.min.js') !!}"></script>

    <script>
        $(document).ready(function() {
            // 1. Popover Logic
            $('.js-filter-chip').on('click', function(e) {
                if ($(e.target).closest('.filter-popover').length) return;
                const $chip = $(this);
                const $popover = $chip.find('.filter-popover');
                const isVisible = $popover.is(':visible');

                $('.filter-popover').fadeOut(100);
                $('.js-filter-chip').removeClass('popover-open');

                if (!isVisible) {
                    $popover.fadeIn(200, function() {
                        // Safety: Check overflows
                        const rect = this.getBoundingClientRect();
                        if (rect.left < 10) $(this).css({
                            left: '0',
                            right: 'auto'
                        });
                        else if (rect.right > (window.innerWidth - 10)) $(this).css({
                            left: 'auto',
                            right: '0'
                        });

                        // Init Select2 if role_popover
                        if ($popover.attr('id') === 'role_popover') {
                            const $select = $popover.find('select');
                            if (!$select.hasClass("select2-hidden-accessible")) {
                                $select.select2({
                                    dropdownParent: $popover,
                                    width: '100%'
                                });
                            }
                        }
                    });
                    $chip.addClass('popover-open');
                }
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.js-filter-chip').length) {
                    $('.filter-popover').fadeOut(100);
                    $('.js-filter-chip').removeClass('popover-open');
                }
            });

            $('.js-apply-filter').on('click', function() {
                const $popover = $(this).closest('.filter-popover');
                const $chip = $popover.closest('.js-filter-chip');
                let hasValue = false;
                $popover.find('input, select').each(function() {
                    if ($(this).val() && $(this).val() !== "") hasValue = true;
                });
                if (hasValue) $chip.addClass('active');
                else $chip.removeClass('active');

                $popover.fadeOut(100);
                $('.js-filter-btn').trigger('click');
            });

            window.initFilterHandler({
                form: ".js-filter-form",
                container: "#table_data",
                loader: ".table-loader-overlay"
            });
        });
    </script>
@endpush
