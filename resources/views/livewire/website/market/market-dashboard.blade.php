<div id="app" class="max-w-md mx-auto min-h-screen relative pb-24 shadow-2xl bg-gray-50/50 dark:bg-[#0b1121] transition-colors duration-300">
    <!-- Header -->
    <header class="p-4 flex items-center justify-between border-b dark:border-gray-800 glass-effect sticky top-0 z-10 transition-colors duration-300">
        <h1 class="text-xl font-bold text-primary flex items-center gap-2">
            <img src="{!! setting()->logo ? asset('uploads/settings/' . setting()->logo) : asset('assets/dashboard/images/dokkana-logo.png') !!}" alt="Logo" class="h-8 w-auto rounded shadow-sm">
            {{ __('website.store_notebook') }}
        </h1>
        <div class="flex items-center gap-2">
            @php
                $currentLocale = app()->getLocale();
                $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
                $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
            @endphp
            <a href="{{ LaravelLocalization::getLocalizedURL($targetLocale, null, [], true) }}" 
               class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors active:scale-95 text-gray-600 dark:text-gray-300 font-bold text-sm flex items-center gap-1">
                <span>{{ $targetNative }}</span>
            </a>
            <button id="themeToggleBtn" onclick="document.documentElement.classList.toggle('dark')" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors active:scale-95">
                <i class="ph-fill ph-moon text-xl dark:hidden text-gray-600"></i>
                <i class="ph-fill ph-sun text-xl hidden dark:block text-yellow-400"></i>
            </button>
            <div wire:loading class="ml-2">
                <i class="ph-bold ph-spinner animate-spin text-xl text-primary"></i>
            </div>
        </div>
    </header>

    <!-- Dashboard Metrics -->
    <div class="p-4">
        <div class="grid grid-cols-2 gap-3 mb-2">
            <div class="col-span-2 bg-gradient-to-br from-emerald-500 to-teal-700 rounded-3xl p-6 text-white shadow-lg shadow-emerald-500/30 relative overflow-hidden transition-transform duration-300 hover:scale-[1.01]">
                <div class="absolute -right-4 -top-4 w-32 h-32 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute top-0 right-0 p-4 opacity-20 pointer-events-none">
                    <i class="ph-fill ph-wallet text-8xl -mt-4 -mr-4"></i>
                </div>
                <p class="text-sm opacity-90 mb-1 font-medium">{{ __('website.total_market_debts') }}</p>
                <h2 class="text-4xl font-black tracking-tight"><span>{{ number_format($totalDebt, 1) }}</span> <span class="text-lg font-normal opacity-80">{{ __('website.currency') }}</span></h2>
            </div>
            
            <div class="bg-white dark:bg-darkCard rounded-[1.25rem] p-4 shadow-sm border border-gray-100 dark:border-gray-800 flex items-center gap-3 transition-colors">
                <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-500 flex items-center justify-center shrink-0">
                    <i class="ph-fill ph-users text-xl"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium whitespace-nowrap">{{ __('website.active_customers') }}</p>
                    <h4 class="text-lg font-black text-gray-800 dark:text-gray-100 leading-tight">{{ $customers->total() }}</h4>
                </div>
            </div>
            
            <div class="bg-white dark:bg-darkCard rounded-[1.25rem] p-4 shadow-sm border border-gray-100 dark:border-gray-800 flex items-center gap-3 transition-colors">
                <div class="w-10 h-10 rounded-full bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 flex items-center justify-center shrink-0">
                    <i class="ph-fill ph-trend-up text-xl"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium whitespace-nowrap">{{ __('website.today_collections') }}</p>
                    <h4 class="text-lg font-black text-gray-800 dark:text-gray-100 leading-tight">{{ number_format($todayCollections, 1) }} <span class="text-[10px] font-normal text-gray-500">{{ __('website.currency') }}</span></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="px-4 mb-4">
        <div class="relative group mb-3">
            <i class="ph ph-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg group-focus-within:text-primary transition-colors"></i>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="{{ __('website.search_customer') }}" class="w-full bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-2xl py-3.5 pr-11 pl-4 focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all text-gray-800 dark:text-gray-100 shadow-sm placeholder-gray-400">
        </div>
        <div class="flex gap-2 overflow-x-auto pb-1 hide-scrollbar">
            <button wire:click="setFilter('all')" class="whitespace-nowrap px-4 py-1.5 rounded-full border border-gray-200 dark:border-gray-700 text-sm font-bold {{ $filter === 'all' ? 'bg-primary text-white' : 'text-gray-600 dark:text-gray-300 bg-white dark:bg-darkCard' }}">{{ __('website.filter_all') }}</button>
            <button wire:click="setFilter('debt')" class="whitespace-nowrap px-4 py-1.5 rounded-full border border-gray-200 dark:border-gray-700 text-sm font-bold {{ $filter === 'debt' ? 'bg-primary text-white' : 'text-gray-600 dark:text-gray-300 bg-white dark:bg-darkCard' }}">{{ __('website.filter_has_debt') }}</button>
            <button wire:click="setFilter('paid')" class="whitespace-nowrap px-4 py-1.5 rounded-full border border-gray-200 dark:border-gray-700 text-sm font-bold {{ $filter === 'paid' ? 'bg-primary text-white' : 'text-gray-600 dark:text-gray-300 bg-white dark:bg-darkCard' }}">{{ __('website.filter_paid') }}</button>
        </div>
    </div>

    <!-- Customer List -->
    <div class="px-4 pb-4 relative">
        <div wire:loading.flex wire:target="search, setFilter" class="absolute inset-0 bg-white/50 dark:bg-black/50 z-10 flex items-center justify-center rounded-xl backdrop-blur-sm">
            <i class="ph-bold ph-spinner-gap animate-spin text-4xl text-primary"></i>
        </div>

        <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 mb-3 px-1">{{ __('website.customers_list') }}</h3>
        
        @if($customers->isEmpty() && !$search && $filter === 'all')
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center py-16 text-gray-400">
            <div class="w-24 h-24 mb-4 opacity-50">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-full h-full text-gray-300 dark:text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <p class="font-bold text-gray-600 dark:text-gray-300 text-lg mb-1">{{ __('website.no_customers_added') }}</p>
            <p class="text-sm text-gray-400 dark:text-gray-500">{{ __('website.click_to_add_first_customer') }}</p>
        </div>
        @elseif($customers->isEmpty())
        <!-- No Results -->
        <div class="flex flex-col items-center justify-center py-16 text-gray-400">
            <i class="ph-fill ph-magnifying-glass-minus text-5xl text-gray-300 dark:text-gray-600 mb-3"></i>
            <p class="font-bold text-gray-500 dark:text-gray-400">{{ __('website.no_results') }}</p>
        </div>
        @else
        <div class="space-y-3">
            @php
                $avatarColors = [
                    'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400',
                    'bg-orange-100 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400',
                    'bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400',
                    'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400',
                    'bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400',
                    'bg-teal-100 text-teal-600 dark:bg-teal-900/30 dark:text-teal-400',
                    'bg-cyan-100 text-cyan-600 dark:bg-cyan-900/30 dark:text-cyan-400',
                    'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400',
                    'bg-indigo-100 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400',
                    'bg-violet-100 text-violet-600 dark:bg-violet-900/30 dark:text-violet-400',
                    'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400',
                    'bg-fuchsia-100 text-fuchsia-600 dark:bg-fuchsia-900/30 dark:text-fuchsia-400',
                    'bg-pink-100 text-pink-600 dark:bg-pink-900/30 dark:text-pink-400',
                    'bg-rose-100 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400'
                ];
            @endphp
            @foreach($customers as $idx => $customer)
                @php
                    $hash = 0;
                    for ($i = 0; $i < mb_strlen($customer->name); $i++) {
                        $hash = mb_ord(mb_substr($customer->name, $i, 1)) + (($hash << 5) - $hash);
                    }
                    $colorClass = $avatarColors[abs($hash) % count($avatarColors)];
                    $lastTx = $customer->transactions->first() ? $customer->transactions->first()->created_at->format('Y-m-d') : 'لا يوجد حركات';
                    $balance = $customer->balance;
                    $isDebt = $balance > 0;
                @endphp
                <div wire:click="openLedger({{ $customer->id }})" class="bg-white dark:bg-darkCard p-4 rounded-[1.25rem] border border-gray-100 dark:border-gray-800 flex justify-between items-center cursor-pointer hover:border-primary/50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shrink-0 shadow-sm {{ $colorClass }}">
                            {{ mb_substr($customer->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-gray-100 text-base leading-tight">{{ $customer->name }}</h4>
                            <p class="text-[11px] text-gray-400 dark:text-gray-500 mt-1 font-medium flex items-center gap-1">
                                <i class="ph-fill ph-clock text-xs"></i> {{ $lastTx }}
                            </p>
                        </div>
                    </div>
                    <div class="text-left flex flex-col items-end">
                        <span class="font-black text-lg {{ $isDebt ? 'text-red-500' : ($balance < 0 ? 'text-emerald-500' : 'text-gray-500 dark:text-gray-400') }} leading-tight">
                            {{ number_format(abs($balance), 1) }}
                        </span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full mt-1 {{ $isDebt ? 'bg-red-50 text-red-600 dark:bg-red-900/20 dark:text-red-400' : ($balance < 0 ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400' : 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400') }}">
                            {{ $isDebt ? 'عليه دين' : ($balance < 0 ? 'له رصيد' : 'خالص') }}
                        </span>
                    </div>
                </div>
            @endforeach
            
            @if($customers->hasPages())
                <div class="mt-4">
                    {{ $customers->links(data: ['scrollTo' => false]) }}
                </div>
            @endif
        </div>
        @endif
    </div>

    <!-- Add Customer FAB -->
    <button x-data x-on:click="$dispatch('open-modal', { id: 'addCustomerModal' })" class="fixed bottom-6 right-1/2 translate-x-1/2 sm:translate-x-0 sm:right-6 bg-primary hover:bg-emerald-600 text-white w-16 h-16 rounded-2xl shadow-[0_8px_30px_rgb(16,185,129,0.4)] flex items-center justify-center transition-all hover:-translate-y-1 active:scale-95 z-20 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 group">
        <i class="ph-bold ph-plus text-3xl group-hover:rotate-90 transition-transform duration-300"></i>
    </button>

    <!-- Modals -->
    <!-- Add Customer Modal -->
    <div x-data="{ show: false }" 
         x-show="show" 
         x-on:open-modal.window="if ($event.detail.id === 'addCustomerModal') show = true"
         x-on:close-modal.window="if ($event.detail.id === 'addCustomerModal') show = false"
         style="display: none;"
         class="fixed inset-0 z-50 flex items-end sm:items-center justify-center">
        <div x-show="show" x-transition.opacity class="fixed inset-0 bg-gray-900/75 dark:bg-black/85" x-on:click="show = false"></div>
        <div x-show="show" x-transition.translate.y.bottom class="relative bg-white dark:bg-darkCard w-full max-w-md rounded-t-[2rem] sm:rounded-3xl p-6 shadow-2xl border border-white/10 z-10">
            <div class="w-12 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full mx-auto mb-6 sm:hidden"></div>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="ph-fill ph-user-plus text-primary text-2xl"></i>
                    {{ __('website.add_new_customer') }}
                </h2>
                <button x-on:click="show = false" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-500">
                    <i class="ph-bold ph-x"></i>
                </button>
            </div>
            <form wire:submit.prevent="addCustomer" class="space-y-4">
                <div>
                    <label class="block text-sm font-bold mb-1.5 text-gray-700 dark:text-gray-300">{{ __('website.name') }} <span class="text-red-500">*</span></label>
                    <input wire:model="newCustomerName" type="text" required class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-4 py-3.5 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-medium text-gray-900 dark:text-white placeholder-gray-400">
                    @error('newCustomerName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1.5 text-gray-700 dark:text-gray-300">{{ __('website.phone_optional') }}</label>
                    <input wire:model="newCustomerPhone" type="tel" maxlength="10" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-4 py-3.5 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-medium text-gray-900 dark:text-white placeholder-gray-400" dir="ltr" placeholder="05...">
                    @error('newCustomerPhone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="w-full bg-primary text-white font-bold rounded-xl py-3.5 mt-4 hover:bg-emerald-600 transition-colors active:scale-[0.98] shadow-lg shadow-emerald-500/25 flex items-center justify-center gap-2">
                    <span wire:loading.remove wire:target="addCustomer">{{ __('website.save_customer_data') }}</span>
                    <span wire:loading wire:target="addCustomer"><i class="ph-bold ph-spinner animate-spin"></i> جاري الحفظ...</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Customer Ledger Modal -->
    <div x-data="{ show: false }" 
         x-show="show" 
         x-on:open-modal.window="if ($event.detail.id === 'ledgerModal') show = true"
         x-on:close-modal.window="if ($event.detail.id === 'ledgerModal') show = false"
         style="display: none;"
         class="fixed inset-0 z-40 flex flex-col items-center justify-end sm:justify-center">
        <div x-show="show" x-transition.opacity class="fixed inset-0 bg-gray-900/75 dark:bg-black/85" x-on:click="show = false"></div>
        <div x-show="show" x-transition.translate.y.bottom class="relative bg-gray-50 dark:bg-dark w-full max-w-md h-[92vh] sm:h-[85vh] rounded-t-[2rem] sm:rounded-3xl flex flex-col shadow-2xl overflow-hidden border border-white/10 z-10">
            @if($activeCustomer)
            <!-- Header -->
            <div class="p-5 border-b dark:border-gray-800 flex justify-between items-center bg-white dark:bg-darkCard z-10 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xl">
                        <span>{{ mb_substr($activeCustomer->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-gray-900 dark:text-white">{{ $activeCustomer->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 font-medium">{!! $activeCustomer->phone ? '<i class="ph-fill ph-phone text-xs"></i> ' . $activeCustomer->phone : '-' !!}</p>
                    </div>
                </div>
                <button x-on:click="show = false" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition-colors text-gray-600 dark:text-gray-300">
                    <i class="ph-bold ph-x text-lg"></i>
                </button>
            </div>
            
            <!-- Balance & Actions -->
            <div class="p-5 bg-white dark:bg-darkCard shadow-sm z-10 relative shrink-0">
                <div class="flex justify-between items-end mb-5">
                    <div>
                        <p class="text-sm font-bold text-gray-500 dark:text-gray-400 mb-1">{{ __('website.current_balance') }}</p>
                        <h3 class="text-3xl font-black tracking-tight {{ $activeCustomer->balance > 0 ? 'text-red-500' : ($activeCustomer->balance < 0 ? 'text-emerald-500' : 'text-gray-800 dark:text-white') }}">
                            {{ number_format(abs($activeCustomer->balance), 1) }} <span class="text-base font-normal opacity-80">{{ __('website.currency') }}</span>
                        </h3>
                    </div>
                    <div class="text-xs font-bold px-3 py-1.5 rounded-full {{ $activeCustomer->balance > 0 ? 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400' : ($activeCustomer->balance < 0 ? 'bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400') }}">
                        {{ $activeCustomer->balance > 0 ? 'عليه دين' : ($activeCustomer->balance < 0 ? 'له رصيد' : 'خالص') }}
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <button wire:click="openTxModal('debt')" class="flex flex-col items-center justify-center gap-2 bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40 dark:text-red-400 py-3 rounded-[1rem] font-bold transition-all active:scale-95 border border-red-100 dark:border-red-900/30 group">
                        <div class="w-10 h-10 rounded-full bg-white dark:bg-red-900/40 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                            <i class="ph-bold ph-minus text-xl"></i>
                        </div>
                        {{ __('website.new_debt') }}
                    </button>
                    <button wire:click="openTxModal('payment')" class="flex flex-col items-center justify-center gap-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-900/20 dark:hover:bg-emerald-900/40 dark:text-emerald-400 py-3 rounded-[1rem] font-bold transition-all active:scale-95 border border-emerald-100 dark:border-emerald-900/30 group">
                        <div class="w-10 h-10 rounded-full bg-white dark:bg-emerald-900/40 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                            <i class="ph-bold ph-plus text-xl"></i>
                        </div>
                        {{ __('website.payment_transfer') }}
                    </button>
                </div>
            </div>

            <!-- Transaction List -->
            <div class="flex-1 overflow-y-auto p-4 space-y-3 bg-gray-50/50 dark:bg-[#0b1121] custom-scrollbar relative">
                <div wire:loading.flex wire:target="loadMoreLedger" class="absolute inset-0 bg-white/50 dark:bg-black/50 z-10 flex items-center justify-center rounded-xl backdrop-blur-sm">
                    <i class="ph-bold ph-spinner-gap animate-spin text-4xl text-primary"></i>
                </div>

                @if(count($ledgerTransactions) === 0)
                <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                    <i class="ph-fill ph-receipt text-5xl mb-3 text-gray-300 dark:text-gray-600 opacity-50"></i>
                    <p class="text-sm font-bold">لا يوجد حركات مسجلة</p>
                </div>
                @else
                    @foreach($ledgerTransactions as $tx)
                        @php
                            $isDebt = $tx->type === 'debt';
                        @endphp
                        <div class="bg-white dark:bg-darkCard p-4 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 {{ $isDebt ? 'bg-red-50 text-red-500 dark:bg-red-900/20' : 'bg-emerald-50 text-emerald-500 dark:bg-emerald-900/20' }}">
                                    <i class="ph-bold {{ $isDebt ? 'ph-arrow-up-right' : 'ph-arrow-down-left' }} text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-gray-900 dark:text-gray-100">{{ $tx->description }}</p>
                                    <p class="text-[11px] text-gray-400 dark:text-gray-500 mt-1 font-medium flex items-center gap-1">
                                        <i class="ph-fill ph-calendar text-xs"></i> {{ $tx->created_at->format('Y-m-d') }} - {{ $tx->created_at->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-left font-black shrink-0 text-lg {{ $isDebt ? 'text-red-500' : 'text-emerald-500' }}">
                                {{ $isDebt ? '+' : '-' }}{{ number_format($tx->amount, 1) }} <span class="text-[10px] font-normal">₪</span>
                            </div>
                        </div>
                    @endforeach

                    @if($totalLedgerTransactions > count($ledgerTransactions))
                    <button wire:click="loadMoreLedger" class="w-full py-4 mt-2 text-sm font-bold text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition-colors flex items-center justify-center gap-1 border border-transparent hover:border-gray-200 dark:hover:border-gray-700">
                        عرض حركات أقدم <i class="ph-bold ph-caret-down"></i>
                    </button>
                    @endif
                @endif
            </div>
            @endif
        </div>
    </div>

    <!-- Add Transaction Modal -->
    <div x-data="{ show: false }" 
         x-show="show" 
         x-on:open-modal.window="if ($event.detail.id === 'transactionModal') show = true"
         x-on:close-modal.window="if ($event.detail.id === 'transactionModal') show = false"
         style="display: none;"
         class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center">
        <div x-show="show" x-transition.opacity class="fixed inset-0 bg-gray-900/75 dark:bg-black/85" x-on:click="show = false"></div>
        <div x-show="show" x-transition.translate.y.bottom class="relative bg-white dark:bg-darkCard w-full max-w-md rounded-t-[2rem] sm:rounded-3xl p-6 shadow-2xl border border-white/10 z-10">
            <div class="w-12 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full mx-auto mb-6 sm:hidden"></div>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="ph-fill {{ $txType === 'debt' ? 'ph-minus-circle text-red-500' : 'ph-plus-circle text-emerald-500' }} text-2xl"></i>
                    {{ $txType === 'debt' ? 'إضافة دين جديد' : 'إضافة دفعة / حوالة' }}
                </h2>
                <button x-on:click="show = false" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-500">
                    <i class="ph-bold ph-x"></i>
                </button>
            </div>
            <form wire:submit.prevent="addTransaction" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold mb-1.5 text-gray-700 dark:text-gray-300">{{ __('website.amount_currency') }} <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input wire:model="txAmount" type="number" required min="0.01" step="0.01" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl pe-12 ps-4 py-4 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none text-3xl font-black transition-all text-gray-900 dark:text-white text-start" placeholder="0.00">
                        <span class="absolute end-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-lg">₪</span>
                    </div>
                    @error('txAmount') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1.5 text-gray-700 dark:text-gray-300">{{ __('website.notes_optional') }}</label>
                    <textarea wire:model="txDescription" rows="4" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-4 py-3.5 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-medium text-gray-900 dark:text-white resize-none" placeholder="{{ __('website.example_notes') }}"></textarea>
                    @error('txDescription') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="w-full text-white font-bold rounded-xl py-4 mt-4 transition-all active:scale-[0.98] shadow-lg flex items-center justify-center gap-2 {{ $txType === 'debt' ? 'bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 shadow-red-500/30 ring-red-500/50' : 'bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 shadow-emerald-500/30 ring-emerald-500/50' }} focus:ring-4 focus:outline-none overflow-hidden relative group">
                    <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-white rounded-full group-hover:w-56 group-hover:h-56 opacity-10"></span>
                    <span wire:loading.remove wire:target="addTransaction" class="relative">{{ __('website.register') }}</span>
                    <span wire:loading wire:target="addTransaction" class="relative"><i class="ph-bold ph-spinner animate-spin"></i> جاري التسجيل...</span>
                </button>
            </form>
        </div>
    </div>
</div>
