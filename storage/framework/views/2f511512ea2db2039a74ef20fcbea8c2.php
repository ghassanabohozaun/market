<div class="search-form-premium <?php if($search): ?> focused <?php endif; ?>" id="premiumSearchContainer" x-data="{ focused: false }">
    <div class="search-input-wrapper" :class="{ 'focused': focused }">
        <i class="icon-search"></i>
        <input type="search" 
               class="form-control" 
               id="premiumSearchInput"
               placeholder="<?php echo e(__('navbar.search_here')); ?>" 
               wire:model.live.debounce.300ms="search"
               @focus="focused = true"
               @blur="setTimeout(() => { if(!$wire.search) focused = false }, 200)"
               @keydown.escape.window="focused = false; $wire.set('search', '')"
        >
        <span class="kbd-hint" x-show="!focused && !$wire.search">Ctrl+K</span>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?>
        <div class="search-hud-container visible">
            <div class="search-hud-section">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($results['pages'] ?? []) > 0): ?>
                    <div class="search-hud-section-header"><?php echo e(__('navbar.pages')); ?></div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $results['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($page['url']); ?>" class="search-hud-item">
                            <i class="mdi <?php echo e($page['icon']); ?>"></i>
                            <div class="item-info">
                                <span class="item-name"><?php echo e($page['name']); ?></span>
                                <span class="item-type"><?php echo e(__('navbar.navigation')); ?></span>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($results['actions'] ?? []) > 0): ?>
                    <div class="search-hud-divider"></div>
                    <div class="search-hud-section-header"><?php echo e(__('navbar.actions')); ?></div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $results['actions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($action['url']); ?>" class="search-hud-item">
                            <i class="mdi <?php echo e($action['icon']); ?>"></i>
                            <div class="item-info">
                                <span class="item-name"><?php echo e($action['name']); ?></span>
                                <span class="item-type"><?php echo e(__('navbar.quick_action')); ?></span>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($results['data'] ?? []) > 0): ?>
                    <div class="search-hud-divider"></div>
                    <div class="search-hud-section-header"><?php echo e(__('navbar.data_results')); ?></div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $results['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($item['url']); ?>" class="search-hud-item">
                            <i class="mdi <?php echo e($item['icon']); ?>"></i>
                            <div class="item-info">
                                <span class="item-name"><?php echo e($item['name']); ?></span>
                                <span class="item-type"><?php echo e($item['type']); ?></span>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(collect($results)->flatten(1)->isEmpty()): ?>
                    <div class="search-hud-no-results">
                        <i class="mdi mdi-magnify-minus-outline d-block fs-2 mb-2"></i>
                        <?php echo e(__('navbar.no_results_found')); ?> "<?php echo e($search); ?>"
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\market\resources\views/livewire/dashboard/global-search.blade.php ENDPATH**/ ?>