@props([
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
])

@php
    $inputId = $id ?? $name . '_input';
    $previewId = $inputId . '_preview';
    $resetBtnId = 'reset_' . $inputId . '_btn';
    $errorElementId = $errorId ?? $name . '_error';
    // Improved detection: isEditMode is true only if we have a real URL that isn't a JS placeholder
$isEditMode = !empty($currentImageUrl) && strpos($currentImageUrl, 'javascript:') !== 0;
@endphp

<div class="form-group mb-0 fileinput-component" data-mode="{{ $isEditMode ? 'edit' : 'create' }}"
    data-required="{{ $isRequired ? 'true' : 'false' }}" data-fit="{{ $imageFit }}">
    <label class="form-label-premium">
        <i class="mdi {{ $placeholderIcon }} me-1 text-primary"></i>{!! $label !!}
        @if ($isRequired)
            <span class="text-danger">*</span>
        @endif
    </label>

    <div class="slider-upload-card d-flex align-items-stretch gap-3 border rounded-3 p-3 bg-light">
        <!-- Preview Container -->
        <div id="{{ $previewId }}"
            class="fileinput-preview slider-thumb-preview rounded-3 overflow-hidden border flex-shrink-0 bg-white d-flex align-items-center justify-content-center position-relative"
            style="width:{{ $previewWidth }}; height:{{ $previewHeight }};">

            <!-- Placeholder (Create Mode OR Edit mode when deleted) -->
            <div class="fileinput-placeholder text-center {{ $isEditMode ? 'd-none' : '' }}">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center border mb-2"
                        style="width: 48px; height: 48px; border-style: dashed !important; border-width: 2px !important;">
                        <i class="mdi mdi-plus text-primary fs-4"></i>
                    </div>
                    @if ($placeholderText)
                        <div class="fw-bold small text-muted text-uppercase tracking-wider" style="font-size:0.65rem;">
                            {{ $placeholderText }}</div>
                    @else
                        <div class="fw-bold small text-muted text-uppercase tracking-wider" style="font-size:0.65rem;">
                            {{ __('general.upload') }}</div>
                    @endif
                </div>
            </div>

            <!-- Current Image -->
            <img src="{{ $isEditMode ? $currentImageUrl : '' }}"
                class="fileinput-current-img {{ $isEditMode ? '' : 'd-none' }}"
                onerror="this.classList.add('d-none'); this.parentElement.querySelector('.fileinput-placeholder').classList.remove('d-none');"
                style="width:100%; height:100%; object-fit:{{ $imageFit }} !important; background-color: #f8f9fa;">

            <!-- Local Reset Button (Always hidden initially, shown via JS) -->
            <button type="button" id="{{ $resetBtnId }}"
                class="btn-delete-premium fileinput-local-reset position-absolute top-0 end-0 m-2 shadow-sm d-none"
                style="background: rgba(220, 53, 69, 0.85) !important;" title="{{ __('general.undo') }}">
                <i class="mdi mdi-close"></i>
            </button>
        </div>

        <!-- Input Area -->
        <div class="d-flex flex-column justify-content-center flex-grow-1">
            <div class="mb-1 text-muted small">
                <i class="mdi mdi-cloud-upload-outline me-1"></i>{!! __('general.click_to_upload') !!}
            </div>

            <input type="file" name="{{ $name }}"
                class="form-control form-control-sm fileinput-input fileinput-trigger" id="{{ $inputId }}"
                data-preview="#{{ $previewId }}" accept="image/*">

            <!-- Hidden input to track if the current image was deleted before saving -->
            <input type="hidden" name="is_{{ $name }}_deleted" class="fileinput-deleted-flag" value="0">

            <strong id="{{ $errorElementId }}" class="text-danger small d-block mt-1 fileinput-error"></strong>
        </div>
    </div>
</div>
