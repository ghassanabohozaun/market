{{-- resources/views/components/dashboard/command-hud.blade.php --}}
@props([
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
])

<div class="command-hud-wrapper" id="{{ $hudId }}">
    <div class="hud-capsule d-flex align-items-center">
        {{-- Left: Status & Count --}}
        <div class="hud-status-section d-flex align-items-center border-end pe-3">
            <div class="hud-pulse-orb"></div>
            <div class="lh-1 ms-3">
                <div class="hud-count-text"><span id="{{ $countId }}">0</span> {{ $changesText }}</div>
                <div class="hud-hint-text">{{ $hintText }}</div>
            </div>
        </div>

        {{-- Right: Actions --}}
        <div class="hud-actions-section d-flex align-items-center ps-3 gap-2">
            @if ($showDiscard)
                <button type="button" class="btn-hud-secondary" id="{{ $discardId }}" title="{{ $cancelText }}">
                    <i class="mdi mdi-close"></i>
                    <span class="btn-label">{{ $cancelText }}</span>
                </button>
            @endif

            <button type="submit" @if ($formId) form="{{ $formId }}" @endif
                class="btn-hud-primary" id="{{ $submitId }}">
                <i class="mdi mdi-check-all"></i>
                <span class="btn-label">{{ $saveText }}</span>
                <span class="spinner-border spinner-border-sm d-none spinner_loading" role="status"></span>
            </button>
        </div>
    </div>
</div>
