<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'id' => null,
    'previewWidth' => '240px',
    'previewHeight' => '135px',
    'currentImageUrl' => null,
    'deleteUrl' => null,
    'deleteId' => null,
    'placeholderIcon' => 'mdi-image-outline',
    'placeholderText' => null,
    'isRequired' => false,
    'label' => __('general.photo'),
    'errorId' => null,
    'imageFit' => 'contain',
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
    'name',
    'id' => null,
    'previewWidth' => '240px',
    'previewHeight' => '135px',
    'currentImageUrl' => null,
    'deleteUrl' => null,
    'deleteId' => null,
    'placeholderIcon' => 'mdi-image-outline',
    'placeholderText' => null,
    'isRequired' => false,
    'label' => __('general.photo'),
    'errorId' => null,
    'imageFit' => 'contain',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $inputId = $id ?? $name . '_input';
    $previewId = $inputId . '_preview';
    $resetBtnId = 'reset_' . $inputId . '_btn';
    $errorElementId = $errorId ?? $name . '_error';
    // Improved detection: isEditMode is true only if we have a real URL that isn't a JS placeholder
$isEditMode = !empty($currentImageUrl) && strpos($currentImageUrl, 'javascript:') !== 0;
?>

<div class="form-group mb-0 fileinput-component" data-mode="<?php echo e($isEditMode ? 'edit' : 'create'); ?>"
    data-required="<?php echo e($isRequired ? 'true' : 'false'); ?>" data-fit="<?php echo e($imageFit); ?>">
    <label class="form-label-premium">
        <i class="mdi <?php echo e($placeholderIcon); ?> me-1 text-primary"></i><?php echo $label; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isRequired): ?>
            <span class="text-danger">*</span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </label>

    <div class="slider-upload-card d-flex align-items-stretch gap-3 border rounded-3 p-3 bg-light">
        <!-- Preview Container -->
        <div id="<?php echo e($previewId); ?>"
            class="fileinput-preview slider-thumb-preview rounded-3 overflow-hidden border flex-shrink-0 bg-white d-flex align-items-center justify-content-center position-relative"
            style="width:<?php echo e($previewWidth); ?>; height:<?php echo e($previewHeight); ?>;">

            <!-- Placeholder (Create Mode OR Edit mode when deleted) -->
            <div class="fileinput-placeholder text-center <?php echo e($isEditMode ? 'd-none' : ''); ?>">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center border mb-2"
                        style="width: 48px; height: 48px; border-style: dashed !important; border-width: 2px !important;">
                        <i class="mdi mdi-plus text-primary fs-4"></i>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($placeholderText): ?>
                        <div class="fw-bold small text-muted text-uppercase tracking-wider" style="font-size:0.65rem;">
                            <?php echo e($placeholderText); ?></div>
                    <?php else: ?>
                        <div class="fw-bold small text-muted text-uppercase tracking-wider" style="font-size:0.65rem;">
                            <?php echo e(__('general.upload')); ?></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <!-- Current Image -->
            <img src="<?php echo e($isEditMode ? $currentImageUrl : ''); ?>"
                class="fileinput-current-img <?php echo e($isEditMode ? '' : 'd-none'); ?>"
                onerror="this.classList.add('d-none'); this.parentElement.querySelector('.fileinput-placeholder').classList.remove('d-none');"
                style="width:100%; height:100%; object-fit:<?php echo e($imageFit); ?> !important; background-color: #f8f9fa;">

            <!-- Local Reset Button (Always hidden initially, shown via JS) -->
            <button type="button" id="<?php echo e($resetBtnId); ?>"
                class="btn-delete-premium fileinput-local-reset position-absolute top-0 end-0 m-2 shadow-sm d-none"
                style="background: rgba(220, 53, 69, 0.85) !important;" title="<?php echo e(__('general.undo')); ?>">
                <i class="mdi mdi-close"></i>
            </button>
        </div>

        <!-- Input Area -->
        <div class="d-flex flex-column justify-content-center flex-grow-1">
            <div class="mb-1 text-muted small">
                <i class="mdi mdi-cloud-upload-outline me-1"></i><?php echo __('general.click_to_upload'); ?>

            </div>

            <input type="file" name="<?php echo e($name); ?>"
                class="form-control form-control-sm fileinput-input fileinput-trigger" id="<?php echo e($inputId); ?>"
                data-preview="#<?php echo e($previewId); ?>" accept="image/*">

            <!-- Hidden input to track if the current image was deleted before saving -->
            <input type="hidden" name="is_<?php echo e($name); ?>_deleted" class="fileinput-deleted-flag" value="0">

            <strong id="<?php echo e($errorElementId); ?>" class="text-danger small d-block mt-1 fileinput-error"></strong>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\market\resources\views/components/dashboard/file-input.blade.php ENDPATH**/ ?>