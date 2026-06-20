@extends('layouts.website.app')

@section('title', __('website.store_notebook'))

@section('content')
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
                <button id="themeToggleBtn" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors active:scale-95">
                    <i class="ph-fill ph-moon text-xl dark:hidden text-gray-600"></i>
                    <i class="ph-fill ph-sun text-xl hidden dark:block text-yellow-400"></i>
                </button>
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
                    <h2 class="text-4xl font-black tracking-tight"><span id="totalDebtAmount">0</span> <span class="text-lg font-normal opacity-80">{{ __('website.currency') }}</span></h2>
                </div>
                
                <div class="bg-white dark:bg-darkCard rounded-[1.25rem] p-4 shadow-sm border border-gray-100 dark:border-gray-800 flex items-center gap-3 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-500 flex items-center justify-center shrink-0">
                        <i class="ph-fill ph-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium whitespace-nowrap">{{ __('website.active_customers') }}</p>
                        <h4 class="text-lg font-black text-gray-800 dark:text-gray-100 leading-tight" id="customersCount">0</h4>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-darkCard rounded-[1.25rem] p-4 shadow-sm border border-gray-100 dark:border-gray-800 flex items-center gap-3 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 flex items-center justify-center shrink-0">
                        <i class="ph-fill ph-trend-up text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium whitespace-nowrap">{{ __('website.today_collections') }}</p>
                        <h4 class="text-lg font-black text-gray-800 dark:text-gray-100 leading-tight" id="todayCollectionsCount">0 <span class="text-[10px] font-normal text-gray-500">{{ __('website.currency') }}</span></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Filters -->
        <div class="px-4 mb-4">
            <div class="relative group mb-3">
                <i class="ph ph-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg group-focus-within:text-primary transition-colors"></i>
                <input type="text" id="searchInput" placeholder="{{ __('website.search_customer') }}" class="w-full bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-2xl py-3.5 pr-11 pl-4 focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all text-gray-800 dark:text-gray-100 shadow-sm placeholder-gray-400">
            </div>
            <div class="flex gap-2 overflow-x-auto pb-1 hide-scrollbar" id="filterContainer">
                <button class="filter-btn active whitespace-nowrap px-4 py-1.5 rounded-full border border-gray-200 dark:border-gray-700 text-sm font-bold text-gray-600 dark:text-gray-300 bg-white dark:bg-darkCard" data-filter="all">{{ __('website.filter_all') }}</button>
                <button class="filter-btn whitespace-nowrap px-4 py-1.5 rounded-full border border-gray-200 dark:border-gray-700 text-sm font-bold text-gray-600 dark:text-gray-300 bg-white dark:bg-darkCard" data-filter="debt">{{ __('website.filter_has_debt') }}</button>
                <button class="filter-btn whitespace-nowrap px-4 py-1.5 rounded-full border border-gray-200 dark:border-gray-700 text-sm font-bold text-gray-600 dark:text-gray-300 bg-white dark:bg-darkCard" data-filter="paid">{{ __('website.filter_paid') }}</button>
            </div>
        </div>

        <!-- Customer List -->
        <div class="px-4 pb-4">
            <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 mb-3 px-1">{{ __('website.customers_list') }}</h3>
            <div id="customersList" class="space-y-3">
                <!-- Customer items will be injected here -->
            </div>
            
            <!-- Empty States -->
            <div id="emptyState" class="hidden flex-col items-center justify-center py-16 text-gray-400">
                <div class="w-24 h-24 mb-4 opacity-50">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-full h-full text-gray-300 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <p class="font-bold text-gray-600 dark:text-gray-300 text-lg mb-1">{{ __('website.no_customers_added') }}</p>
                <p class="text-sm text-gray-400 dark:text-gray-500">{{ __('website.click_to_add_first_customer') }}</p>
            </div>

            <div id="noResultsState" class="hidden flex-col items-center justify-center py-16 text-gray-400">
                <i class="ph-fill ph-magnifying-glass-minus text-5xl text-gray-300 dark:text-gray-600 mb-3"></i>
                <p class="font-bold text-gray-500 dark:text-gray-400">{{ __('website.no_results') }}</p>
            </div>
        </div>

        <!-- Add Customer FAB -->
        <button id="addCustomerFab" class="fixed bottom-6 right-1/2 translate-x-1/2 sm:translate-x-0 sm:right-6 bg-primary hover:bg-emerald-600 text-white w-16 h-16 rounded-2xl shadow-[0_8px_30px_rgb(16,185,129,0.4)] flex items-center justify-center transition-all hover:-translate-y-1 active:scale-95 z-20 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 group">
            <i class="ph-bold ph-plus text-3xl group-hover:rotate-90 transition-transform duration-300"></i>
        </button>
    </div>

    <!-- Modals Overlay -->
    <div id="modalsContainer">
        <!-- Add Customer Modal -->
        <div id="addCustomerModal" class="fixed inset-0 bg-gray-900/75 dark:bg-black/85 z-50 hidden flex items-end sm:items-center justify-center">
            <div class="bg-white dark:bg-darkCard w-full max-w-md rounded-t-[2rem] sm:rounded-3xl p-6 shadow-2xl border border-white/10" id="addCustomerModalContent">
                <div class="w-12 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full mx-auto mb-6 sm:hidden"></div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="ph-fill ph-user-plus text-primary text-2xl"></i>
                        {{ __('website.add_new_customer') }}
                    </h2>
                    <button class="close-modal w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-500">
                        <i class="ph-bold ph-x"></i>
                    </button>
                </div>
                <form id="addCustomerForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold mb-1.5 text-gray-700 dark:text-gray-300">{{ __('website.name') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="newCustomerName" required class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-4 py-3.5 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-medium text-gray-900 dark:text-white placeholder-gray-400">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1.5 text-gray-700 dark:text-gray-300">{{ __('website.phone_optional') }}</label>
                        <input type="tel" id="newCustomerPhone" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-4 py-3.5 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-medium text-gray-900 dark:text-white placeholder-gray-400" dir="ltr" placeholder="05...">
                    </div>
                    <button type="submit" class="w-full bg-primary text-white font-bold rounded-xl py-3.5 mt-4 hover:bg-emerald-600 transition-colors active:scale-[0.98] shadow-lg shadow-emerald-500/25">
                        {{ __('website.save_customer_data') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Customer Ledger Modal (Details) -->
        <div id="ledgerModal" class="fixed inset-0 bg-gray-900/75 dark:bg-black/85 z-40 hidden flex flex-col items-center justify-end sm:justify-center">
            <div class="bg-gray-50 dark:bg-dark w-full max-w-md h-[92vh] sm:h-[85vh] rounded-t-[2rem] sm:rounded-3xl flex flex-col shadow-2xl overflow-hidden border border-white/10" id="ledgerModalContent">
                <!-- Header -->
                <div class="p-5 border-b dark:border-gray-800 flex justify-between items-center bg-white dark:bg-darkCard z-10 shrink-0">
                    <div class="flex items-center gap-3">
                        <div id="ledgerAvatarContainer" class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xl">
                            <span id="ledgerAvatar">أ</span>
                        </div>
                        <div>
                            <h2 class="font-bold text-lg text-gray-900 dark:text-white" id="ledgerCustomerName">{{ __('website.customer_name') }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 font-medium" id="ledgerCustomerPhone">-</p>
                        </div>
                    </div>
                    <button class="close-modal w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition-colors text-gray-600 dark:text-gray-300">
                        <i class="ph-bold ph-x text-lg"></i>
                    </button>
                </div>
                
                <!-- Balance & Actions -->
                <div class="p-5 bg-white dark:bg-darkCard shadow-sm z-10 relative shrink-0">
                    <div class="flex justify-between items-end mb-5">
                        <div>
                            <p class="text-sm font-bold text-gray-500 dark:text-gray-400 mb-1">{{ __('website.current_balance') }}</p>
                            <h3 class="text-3xl font-black tracking-tight" id="ledgerBalance">0 <span class="text-base font-normal opacity-80">{{ __('website.currency') }}</span></h3>
                        </div>
                        <div class="text-xs font-bold px-3 py-1.5 rounded-full" id="ledgerStatusBadge">
                            {{ __('website.paid') }}
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <button id="btnOpenAddDebt" class="flex flex-col items-center justify-center gap-2 bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40 dark:text-red-400 py-3 rounded-[1rem] font-bold transition-all active:scale-95 border border-red-100 dark:border-red-900/30 group">
                            <div class="w-10 h-10 rounded-full bg-white dark:bg-red-900/40 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <i class="ph-bold ph-minus text-xl"></i>
                            </div>
                            {{ __('website.new_debt') }}
                        </button>
                        <button id="btnOpenAddPayment" class="flex flex-col items-center justify-center gap-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-900/20 dark:hover:bg-emerald-900/40 dark:text-emerald-400 py-3 rounded-[1rem] font-bold transition-all active:scale-95 border border-emerald-100 dark:border-emerald-900/30 group">
                            <div class="w-10 h-10 rounded-full bg-white dark:bg-emerald-900/40 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <i class="ph-bold ph-plus text-xl"></i>
                            </div>
                            {{ __('website.payment_transfer') }}
                        </button>
                    </div>
                </div>

                <!-- Transaction List -->
                <div class="flex-1 overflow-y-auto p-4 space-y-3 bg-gray-50/50 dark:bg-[#0b1121] custom-scrollbar relative" id="ledgerTransactionsList">
                    <!-- Transactions will go here -->
                </div>
            </div>
        </div>

        <!-- Add Transaction Modal (Debt / Payment) -->
        <div id="transactionModal" class="fixed inset-0 bg-gray-900/75 dark:bg-black/85 z-[60] hidden flex items-end sm:items-center justify-center">
            <div class="bg-white dark:bg-darkCard w-full max-w-md rounded-t-[2rem] sm:rounded-3xl p-6 shadow-2xl border border-white/10" id="transactionModalContent">
                <div class="w-12 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full mx-auto mb-6 sm:hidden"></div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2" id="transactionModalTitle">
                        <i class="ph-fill ph-receipt text-2xl" id="txModalIcon"></i>
                        {{ __('website.add_transaction') }}
                    </h2>
                    <button class="close-tx-modal w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-500">
                        <i class="ph-bold ph-x"></i>
                    </button>
                </div>
                <form id="transactionForm" class="space-y-5">
                    <input type="hidden" id="txType" value="debt">
                    <div>
                        <label class="block text-sm font-bold mb-1.5 text-gray-700 dark:text-gray-300">{{ __('website.amount_currency') }} <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="number" id="txAmount" required min="0.01" step="0.01" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-4 py-4 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none text-3xl font-black transition-all text-gray-900 dark:text-white" dir="ltr" placeholder="0.00">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-lg">₪</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1.5 text-gray-700 dark:text-gray-300">{{ __('website.notes_optional') }}</label>
                        <input type="text" id="txDescription" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-4 py-3.5 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-medium text-gray-900 dark:text-white" placeholder="{{ __('website.example_notes') }}">
                    </div>
                    <button type="submit" id="txSubmitBtn" class="w-full text-white font-bold rounded-xl py-4 mt-4 hover:opacity-90 transition-all active:scale-[0.98] shadow-lg bg-primary">
                        {{ __('website.register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection