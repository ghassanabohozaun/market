<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo asset('assets/dashboard/css/filter.css'); ?>">
<?php $__env->stopPush(); ?>

<div class="query-bar-container">
    <div class="query-bar js-query-bar">
        <span class="query-bar-label">
            <i class="mdi mdi-magnify"></i> <?php echo __('general.search'); ?>:
        </span>

        <form class="js-filter-form d-flex align-items-center gap-2">
            <!-- Search Term Chip -->
            <div class="filter-chip js-filter-chip" data-target="search_popover">
                <i class="mdi mdi-map-search-outline"></i>
                <span class="chip-text"><?php echo __('general.search'); ?></span>
                <div class="filter-popover" id="search_popover">
                    <div class="mb-3 theme-primary">
                        <label class="form-label d-block fw-bold mb-1"><?php echo __('general.search'); ?></label>
                        <div class="input-group-premium">
                            <span class="input-group-text"><i class="mdi mdi-earth"></i></span>
                            <input type="text" class="form-control" name="search_term"
                                placeholder="<?php echo __('addresses.search_placeholder'); ?>">
                        </div>
                    </div>
                    <div class="popover-actions">
                        <button type="button"
                            class="btn btn-primary btn-sm text-white js-apply-filter"><?php echo __('general.apply'); ?></button>
                    </div>
                </div>
            </div>

            <!-- Reset Button -->
            <div class="filter-chip reset-chip js-reset-btn">
                <i class="mdi mdi-refresh"></i>
                <span><?php echo __('general.reset'); ?></span>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
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

            window.initFilterHandler({
                form: ".js-filter-form",
                container: "#table_data",
                loader: ".table-loader-overlay"
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\market\resources\views/dashboard/addresses/countries/partials/_search.blade.php ENDPATH**/ ?>