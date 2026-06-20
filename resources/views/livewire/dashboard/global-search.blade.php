<div class="search-form-premium @if($search) focused @endif" id="premiumSearchContainer" x-data="{ focused: false }">
    <div class="search-input-wrapper" :class="{ 'focused': focused }">
        <i class="icon-search"></i>
        <input type="search" 
               class="form-control" 
               id="premiumSearchInput"
               placeholder="{{ __('navbar.search_here') }}" 
               wire:model.live.debounce.300ms="search"
               @focus="focused = true"
               @blur="setTimeout(() => { if(!$wire.search) focused = false }, 200)"
               @keydown.escape.window="focused = false; $wire.set('search', '')"
        >
        <span class="kbd-hint" x-show="!focused && !$wire.search">Ctrl+K</span>
    </div>

    @if($search)
        <div class="search-hud-container visible">
            <div class="search-hud-section">
                @if(count($results['pages'] ?? []) > 0)
                    <div class="search-hud-section-header">{{ __('navbar.pages') }}</div>
                    @foreach($results['pages'] as $page)
                        <a href="{{ $page['url'] }}" class="search-hud-item">
                            <i class="mdi {{ $page['icon'] }}"></i>
                            <div class="item-info">
                                <span class="item-name">{{ $page['name'] }}</span>
                                <span class="item-type">{{ __('navbar.navigation') }}</span>
                            </div>
                        </a>
                    @endforeach
                @endif

                @if(count($results['actions'] ?? []) > 0)
                    <div class="search-hud-divider"></div>
                    <div class="search-hud-section-header">{{ __('navbar.actions') }}</div>
                    @foreach($results['actions'] as $action)
                        <a href="{{ $action['url'] }}" class="search-hud-item">
                            <i class="mdi {{ $action['icon'] }}"></i>
                            <div class="item-info">
                                <span class="item-name">{{ $action['name'] }}</span>
                                <span class="item-type">{{ __('navbar.quick_action') }}</span>
                            </div>
                        </a>
                    @endforeach
                @endif

                @if(count($results['data'] ?? []) > 0)
                    <div class="search-hud-divider"></div>
                    <div class="search-hud-section-header">{{ __('navbar.data_results') }}</div>
                    @foreach($results['data'] as $item)
                        <a href="{{ $item['url'] }}" class="search-hud-item">
                            <i class="mdi {{ $item['icon'] }}"></i>
                            <div class="item-info">
                                <span class="item-name">{{ $item['name'] }}</span>
                                <span class="item-type">{{ $item['type'] }}</span>
                            </div>
                        </a>
                    @endforeach
                @endif

                @if(collect($results)->flatten(1)->isEmpty())
                    <div class="search-hud-no-results">
                        <i class="mdi mdi-magnify-minus-outline d-block fs-2 mb-2"></i>
                        {{ __('navbar.no_results_found') }} "{{ $search }}"
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
