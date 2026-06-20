@props(['icon' => 'mdi-database-off-outline', 'message' => ''])

<div class="empty-state">
    <i class="mdi {{ $icon }}"></i>
    <div class="empty-text">
        {!! $message ?: __('general.no_record_found') !!}
    </div>
</div>
