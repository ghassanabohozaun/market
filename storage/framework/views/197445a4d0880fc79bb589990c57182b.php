
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'formId' => '',
    'hudId' => 'commandHud',
    'countId' => 'changeCount',
    'submitId' => 'btnHudSave',
    'discardId' => 'btnHudDiscard',
    'showDiscard' => true,
    'changesText' => __('settings.changes_detected'),
    'hintText' => __('settings.unsaved_changes_hint'),
    'saveText' => __('general.save'),
    'cancelText' => __('general.cancel'),
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'formId' => '',
    'hudId' => 'commandHud',
    'countId' => 'changeCount',
    'submitId' => 'btnHudSave',
    'discardId' => 'btnHudDiscard',
    'showDiscard' => true,
    'changesText' => __('settings.changes_detected'),
    'hintText' => __('settings.unsaved_changes_hint'),
    'saveText' => __('general.save'),
    'cancelText' => __('general.cancel'),
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="command-hud-wrapper" id="<?php echo e($hudId); ?>">
    <div class="hud-capsule d-flex align-items-center">
        
        <div class="hud-status-section d-flex align-items-center border-end pe-3">
            <div class="hud-pulse-orb"></div>
            <div class="lh-1 ms-3">
                <div class="hud-count-text"><span id="<?php echo e($countId); ?>">0</span> <?php echo e($changesText); ?></div>
                <div class="hud-hint-text"><?php echo e($hintText); ?></div>
            </div>
        </div>

        
        <div class="hud-actions-section d-flex align-items-center ps-3 gap-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDiscard): ?>
                <button type="button" class="btn-hud-secondary" id="<?php echo e($discardId); ?>" title="<?php echo e($cancelText); ?>">
                    <i class="mdi mdi-close"></i>
                    <span class="btn-label"><?php echo e($cancelText); ?></span>
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <button type="submit" <?php if($formId): ?> form="<?php echo e($formId); ?>" <?php endif; ?>
                class="btn-hud-primary" id="<?php echo e($submitId); ?>">
                <i class="mdi mdi-check-all"></i>
                <span class="btn-label"><?php echo e($saveText); ?></span>
                <span class="spinner-border spinner-border-sm d-none spinner_loading" role="status"></span>
            </button>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\market\resources\views/components/dashboard/command-hud.blade.php ENDPATH**/ ?>