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
                <i class="mdi mdi-magnify-scan"></i>
                <span class="chip-text">{!! __('general.search') !!}</span>
                <div class="filter-popover" id="search_popover">
                    <div class="mb-3 theme-primary">
                        <label class="form-label d-block fw-bold mb-1">{!! __('general.search') !!}</label>
                        <div class="input-group-premium">
                            <span class="input-group-text"><i class="mdi mdi-tag-text-outline"></i></span>
                            <input type="text" class="form-control" name="search_term"
                                placeholder="{!! __('categories.search_placeholder') !!}">
                        </div>
                    </div>
                    <div class="popover-actions">
                        <button type="button"
                            class="btn btn-primary btn-sm text-white js-apply-filter">{!! __('general.apply') !!}</button>
                    </div>
                </div>
            </div>

            <!-- Parent Category Filter Chip (Generic Example) -->
            <div class="filter-chip js-filter-chip" data-target="status_popover">
                <i class="mdi mdi-toggle-switch-outline"></i>
                <span class="chip-text">{!! __('categories.status') !!}</span>
                <div class="filter-popover" id="status_popover">
                    <div class="mb-3 theme-warning">
                        <label class="form-label d-block fw-bold mb-1">{!! __('categories.status') !!}</label>
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
                        const rect = this.getBoundingClientRect();
                        if (rect.left < 10) $(this).css({
                            left: '0',
                            right: 'auto'
                        });
                        else if (rect.right > (window.innerWidth - 10)) $(this).css({
                            left: 'auto',
                            right: '0'
                        });
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

            // Reset Button (Handled by initFilterHandler globally)

            $('<button type="button" class="js-filter-btn d-none"></button>').appendTo('.js-filter-form');

            window.initFilterHandler({
                form: ".js-filter-form",
                container: "#table_data",
                loader: ".table-loader-overlay"
            });
        });
    </script>
@endpush
