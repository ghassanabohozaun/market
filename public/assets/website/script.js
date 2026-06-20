// --- Data Layer (LocalStorage wrapper) ---
const DB_CUSTOMERS_KEY = 'grocery_customers';
const DB_TRANSACTIONS_KEY = 'grocery_transactions';

class LocalDB {
    static getCustomers() {
        return JSON.parse(localStorage.getItem(DB_CUSTOMERS_KEY)) || [];
    }
    
    static saveCustomers(customers) {
        localStorage.setItem(DB_CUSTOMERS_KEY, JSON.stringify(customers));
    }
    
    static getTransactions() {
        return JSON.parse(localStorage.getItem(DB_TRANSACTIONS_KEY)) || [];
    }
    
    static saveTransactions(transactions) {
        localStorage.setItem(DB_TRANSACTIONS_KEY, JSON.stringify(transactions));
    }
    
    static addCustomer(name, phone) {
        const customers = this.getCustomers();
        const newCustomer = {
            id: Date.now().toString(),
            name,
            phone,
            createdAt: new Date().toISOString()
        };
        customers.push(newCustomer);
        this.saveCustomers(customers);
        return newCustomer;
    }
    
    static addTransaction(customerId, type, amount, description) {
        const transactions = this.getTransactions();
        const newTx = {
            id: Date.now().toString(),
            customerId,
            type, // 'debt' or 'payment'
            amount: parseFloat(amount),
            description: description || (type === 'debt' ? 'دين' : 'دفعة'),
            createdAt: new Date().toISOString()
        };
        transactions.push(newTx);
        this.saveTransactions(transactions);
        return newTx;
    }
    
    static getCustomerBalance(customerId) {
        const transactions = this.getTransactions().filter(tx => tx.customerId === customerId);
        let balance = 0;
        transactions.forEach(tx => {
            if (tx.type === 'debt') balance += tx.amount;
            if (tx.type === 'payment') balance -= tx.amount;
        });
        return balance;
    }
    
    static getTotalDebt() {
        const customers = this.getCustomers();
        let total = 0;
        customers.forEach(c => {
            const bal = this.getCustomerBalance(c.id);
            if (bal > 0) total += bal; // Only count debts, not overpayments
        });
        return total;
    }

    static getTodayCollections() {
        const today = new Date().toLocaleDateString();
        const transactions = this.getTransactions();
        let total = 0;
        transactions.forEach(tx => {
            if (tx.type === 'payment' && new Date(tx.createdAt).toLocaleDateString() === today) {
                total += tx.amount;
            }
        });
        return total;
    }

    static getCustomerTransactions(customerId) {
        return this.getTransactions()
            .filter(tx => tx.customerId === customerId)
            .sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt)); // Newest first
    }
}

// --- Avatar Helpers ---
const avatarColors = [
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

function getAvatarColorClass(name) {
    let hash = 0;
    for (let i = 0; i < name.length; i++) {
        hash = name.charCodeAt(i) + ((hash << 5) - hash);
    }
    const index = Math.abs(hash) % avatarColors.length;
    return avatarColors[index];
}

// --- UI Logic ---
document.addEventListener('DOMContentLoaded', () => {
    // State
    let currentActiveCustomerId = null;
    let currentLedgerPage = 1;
    let currentFilter = 'all';
    const TX_PER_PAGE = 15;

    // DOM Elements
    const customersListEl = document.getElementById('customersList');
    const emptyStateEl = document.getElementById('emptyState');
    const noResultsStateEl = document.getElementById('noResultsState');
    const searchInput = document.getElementById('searchInput');
    const totalDebtAmountEl = document.getElementById('totalDebtAmount');
    const customersCountEl = document.getElementById('customersCount');
    const todayCollectionsCountEl = document.getElementById('todayCollectionsCount');
    
    // Theme Toggle
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const htmlEl = document.documentElement;
    
    // Check local storage for theme
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        htmlEl.classList.add('dark');
    } else {
        htmlEl.classList.remove('dark');
    }

    themeToggleBtn.addEventListener('click', () => {
        htmlEl.classList.toggle('dark');
        if (htmlEl.classList.contains('dark')) {
            localStorage.theme = 'dark';
        } else {
            localStorage.theme = 'light';
        }
    });

    // Filters
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            filterBtns.forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');
            currentFilter = e.target.dataset.filter;
            renderDashboard(searchInput.value);
        });
    });

    // Modal Helpers
    const openModal = (modalId, contentId) => {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(contentId);
        modal.classList.remove('hidden');
        // Trigger reflow
        void modal.offsetWidth;
        modal.classList.add('modal-show');
        content.classList.add('modal-content-show');
        document.body.classList.add('modal-open');
    };

    const closeModal = (modalId, contentId) => {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(contentId);
        modal.classList.remove('modal-show');
        content.classList.remove('modal-content-show');
        document.body.classList.remove('modal-open');
        modal.classList.add('hidden');
    };

    // Close buttons logic
    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.fixed');
            const content = modal.querySelector('div[id$="Content"]');
            closeModal(modal.id, content.id);
        });
    });

    // Close tx modal specifically
    document.querySelectorAll('.close-tx-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            closeModal('transactionModal', 'transactionModalContent');
        });
    });

    // Render Dashboard
    const renderDashboard = (searchQuery = '') => {
        const customers = LocalDB.getCustomers();
        customersListEl.innerHTML = '';
        
        let filtered = customers.map(c => {
            return { ...c, balance: LocalDB.getCustomerBalance(c.id) };
        });

        // Filter by Query
        if (searchQuery) {
            filtered = filtered.filter(c => c.name.toLowerCase().includes(searchQuery.toLowerCase()));
        }

        // Filter by Tab (all, debt, paid)
        if (currentFilter === 'debt') {
            filtered = filtered.filter(c => c.balance > 0);
        } else if (currentFilter === 'paid') {
            filtered = filtered.filter(c => c.balance <= 0);
        }

        // Show/Hide States
        if (customers.length === 0) {
            emptyStateEl.classList.remove('hidden');
            emptyStateEl.classList.add('flex');
            noResultsStateEl.classList.add('hidden');
            noResultsStateEl.classList.remove('flex');
        } else if (filtered.length === 0) {
            emptyStateEl.classList.add('hidden');
            emptyStateEl.classList.remove('flex');
            noResultsStateEl.classList.remove('hidden');
            noResultsStateEl.classList.add('flex');
        } else {
            emptyStateEl.classList.add('hidden');
            emptyStateEl.classList.remove('flex');
            noResultsStateEl.classList.add('hidden');
            noResultsStateEl.classList.remove('flex');
            
            // Sort by latest added customer for now, or alphabetical
            filtered.sort((a,b) => new Date(b.createdAt) - new Date(a.createdAt)).forEach((customer, idx) => {
                const balance = customer.balance;
                const isDebt = balance > 0;
                const txs = LocalDB.getCustomerTransactions(customer.id);
                const lastTx = txs.length > 0 ? new Date(txs[0].createdAt).toLocaleDateString('ar-EG') : 'لا يوجد حركات';
                
                const card = document.createElement('div');
                card.className = `customer-card bg-white dark:bg-darkCard p-4 rounded-[1.25rem] border border-gray-100 dark:border-gray-800 flex justify-between items-center cursor-pointer stagger-${(idx % 4) + 1}`;
                card.innerHTML = `
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shrink-0 shadow-sm ${getAvatarColorClass(customer.name)}">
                            ${customer.name.charAt(0)}
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-gray-100 text-base leading-tight">${customer.name}</h4>
                            <p class="text-[11px] text-gray-400 dark:text-gray-500 mt-1 font-medium flex items-center gap-1">
                                <i class="ph-fill ph-clock text-xs"></i> ${lastTx}
                            </p>
                        </div>
                    </div>
                    <div class="text-left flex flex-col items-end">
                        <span class="font-black text-lg ${isDebt ? 'text-red-500' : (balance < 0 ? 'text-emerald-500' : 'text-gray-500 dark:text-gray-400')} leading-tight">
                            ${Math.abs(balance).toLocaleString('en-US', { minimumFractionDigits: 1, maximumFractionDigits: 1 })} 
                        </span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full mt-1 ${isDebt ? 'bg-red-50 text-red-600 dark:bg-red-900/20 dark:text-red-400' : (balance < 0 ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400' : 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400')}">
                            ${isDebt ? 'عليه دين' : (balance < 0 ? 'له رصيد' : 'خالص')}
                        </span>
                    </div>
                `;
                
                card.addEventListener('click', () => openLedger(customer.id));
                customersListEl.appendChild(card);
            });
        }

        // Update Dashboard Metrics
        totalDebtAmountEl.textContent = LocalDB.getTotalDebt().toLocaleString('en-US', { minimumFractionDigits: 1, maximumFractionDigits: 1 });
        customersCountEl.textContent = customers.length;
        todayCollectionsCountEl.innerHTML = `${LocalDB.getTodayCollections().toLocaleString('en-US', { minimumFractionDigits: 1, maximumFractionDigits: 1 })} <span class="text-[10px] font-normal text-gray-500">₪</span>`;
    };

    // Search input
    searchInput.addEventListener('input', (e) => {
        renderDashboard(e.target.value);
    });

    // Add Customer Flow
    const addCustomerFab = document.getElementById('addCustomerFab');
    addCustomerFab.addEventListener('click', () => {
        document.getElementById('newCustomerName').value = '';
        document.getElementById('newCustomerPhone').value = '';
        openModal('addCustomerModal', 'addCustomerModalContent');
        setTimeout(() => document.getElementById('newCustomerName').focus(), 100);
    });

    document.getElementById('addCustomerForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('newCustomerName').value.trim();
        const phone = document.getElementById('newCustomerPhone').value.trim();
        if (name) {
            LocalDB.addCustomer(name, phone);
            closeModal('addCustomerModal', 'addCustomerModalContent');
            searchInput.value = ''; // clear search
            renderDashboard();
        }
    });

    // Ledger Flow
    const openLedger = (customerId) => {
        currentActiveCustomerId = customerId;
        currentLedgerPage = 1;
        const customers = LocalDB.getCustomers();
        const customer = customers.find(c => c.id === customerId);
        if(!customer) return;

        // Populate Ledger Header
        document.getElementById('ledgerAvatar').textContent = customer.name.charAt(0);
        document.getElementById('ledgerAvatarContainer').className = `w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl ${getAvatarColorClass(customer.name)}`;
        document.getElementById('ledgerCustomerName').textContent = customer.name;
        document.getElementById('ledgerCustomerPhone').innerHTML = customer.phone ? `<i class="ph-fill ph-phone text-xs"></i> ${customer.phone}` : '-';
        
        renderLedgerTransactions();
        openModal('ledgerModal', 'ledgerModalContent');
    };

    const renderLedgerTransactions = (appendOnly = false) => {
        const balance = LocalDB.getCustomerBalance(currentActiveCustomerId);
        const balEl = document.getElementById('ledgerBalance');
        const badgeEl = document.getElementById('ledgerStatusBadge');
        
        balEl.innerHTML = `${Math.abs(balance).toLocaleString('en-US', { minimumFractionDigits: 1, maximumFractionDigits: 1 })} <span class="text-base font-normal opacity-80">₪</span>`;
        if (balance > 0) {
            balEl.className = 'text-3xl font-black tracking-tight text-red-500';
            badgeEl.textContent = 'عليه دين';
            badgeEl.className = 'text-xs font-bold px-3 py-1.5 rounded-full bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400';
        } else if (balance < 0) {
            balEl.className = 'text-3xl font-black tracking-tight text-emerald-500';
            badgeEl.textContent = 'له رصيد';
            badgeEl.className = 'text-xs font-bold px-3 py-1.5 rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400';
        } else {
            balEl.className = 'text-3xl font-black tracking-tight text-gray-800 dark:text-white';
            badgeEl.textContent = 'خالص';
            badgeEl.className = 'text-xs font-bold px-3 py-1.5 rounded-full bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400';
        }

        const txList = document.getElementById('ledgerTransactionsList');
        if (!appendOnly) {
            txList.innerHTML = '';
        } else {
            const oldBtn = document.getElementById('loadMoreTxsBtn');
            if (oldBtn) oldBtn.remove();
        }
        
        const txs = LocalDB.getCustomerTransactions(currentActiveCustomerId);
        if (txs.length === 0) {
            txList.innerHTML = '<div class="flex flex-col items-center justify-center py-16 text-gray-400"><i class="ph-fill ph-receipt text-5xl mb-3 text-gray-300 dark:text-gray-600 opacity-50"></i><p class="text-sm font-bold">لا يوجد حركات مسجلة</p></div>';
        } else {
            let chunkToRender = [];
            if (appendOnly) {
                const startIndex = (currentLedgerPage - 1) * TX_PER_PAGE;
                const endIndex = currentLedgerPage * TX_PER_PAGE;
                chunkToRender = txs.slice(startIndex, endIndex);
            } else {
                chunkToRender = txs.slice(0, currentLedgerPage * TX_PER_PAGE);
            }

            chunkToRender.forEach(tx => {
                const date = new Date(tx.createdAt);
                const isDebt = tx.type === 'debt';
                
                const item = document.createElement('div');
                item.className = 'bg-white dark:bg-darkCard p-4 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm flex justify-between items-center';
                item.innerHTML = `
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 ${isDebt ? 'bg-red-50 text-red-500 dark:bg-red-900/20' : 'bg-emerald-50 text-emerald-500 dark:bg-emerald-900/20'}">
                            <i class="ph-bold ${isDebt ? 'ph-arrow-up-right' : 'ph-arrow-down-left'} text-lg"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-gray-900 dark:text-gray-100">${tx.description}</p>
                            <p class="text-[11px] text-gray-400 dark:text-gray-500 mt-1 font-medium flex items-center gap-1"><i class="ph-fill ph-calendar text-xs"></i> ${date.toLocaleDateString('ar-EG')} - ${date.toLocaleTimeString('ar-EG', {hour:'2-digit', minute:'2-digit'})}</p>
                        </div>
                    </div>
                    <div class="text-left font-black shrink-0 text-lg ${isDebt ? 'text-red-500' : 'text-emerald-500'}">
                        ${isDebt ? '+' : '-'}${tx.amount.toLocaleString('en-US', { minimumFractionDigits: 1, maximumFractionDigits: 1 })} <span class="text-[10px] font-normal">₪</span>
                    </div>
                `;
                txList.appendChild(item);
            });

            if (txs.length > currentLedgerPage * TX_PER_PAGE) {
                const loadMoreBtn = document.createElement('button');
                loadMoreBtn.id = 'loadMoreTxsBtn';
                loadMoreBtn.className = 'w-full py-4 mt-2 text-sm font-bold text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition-colors flex items-center justify-center gap-1 border border-transparent hover:border-gray-200 dark:hover:border-gray-700';
                loadMoreBtn.innerHTML = 'عرض حركات أقدم <i class="ph-bold ph-caret-down"></i>';
                loadMoreBtn.addEventListener('click', () => {
                    currentLedgerPage++;
                    renderLedgerTransactions(true);
                });
                txList.appendChild(loadMoreBtn);
            }
        }
        
        // Also refresh dashboard behind
        if (!appendOnly) {
            renderDashboard(searchInput.value);
        }
    };

    // Add Transaction Flow
    const btnOpenAddDebt = document.getElementById('btnOpenAddDebt');
    const btnOpenAddPayment = document.getElementById('btnOpenAddPayment');

    const openTxModal = (type) => {
        document.getElementById('txType').value = type;
        document.getElementById('txAmount').value = '';
        document.getElementById('txDescription').value = '';
        
        const isDebt = type === 'debt';
        document.getElementById('transactionModalTitle').innerHTML = isDebt ? '<i class="ph-fill ph-minus-circle text-red-500 text-2xl"></i> إضافة دين جديد' : '<i class="ph-fill ph-plus-circle text-emerald-500 text-2xl"></i> إضافة دفعة / حوالة';
        const submitBtn = document.getElementById('txSubmitBtn');
        
        // Setup styling based on type
        if(isDebt) {
            submitBtn.className = 'w-full bg-red-500 text-white font-bold rounded-xl py-4 mt-4 hover:bg-red-600 transition-all active:scale-[0.98] shadow-lg shadow-red-500/30';
            submitBtn.textContent = 'تسجيل الدين';
        } else {
            submitBtn.className = 'w-full bg-emerald-500 text-white font-bold rounded-xl py-4 mt-4 hover:bg-emerald-600 transition-all active:scale-[0.98] shadow-lg shadow-emerald-500/30';
            submitBtn.textContent = 'تسجيل الدفعة';
        }

        openModal('transactionModal', 'transactionModalContent');
        setTimeout(() => document.getElementById('txAmount').focus(), 100);
    };

    btnOpenAddDebt.addEventListener('click', () => openTxModal('debt'));
    btnOpenAddPayment.addEventListener('click', () => openTxModal('payment'));

    document.getElementById('transactionForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const type = document.getElementById('txType').value;
        const amount = document.getElementById('txAmount').value;
        const desc = document.getElementById('txDescription').value.trim();

        if (amount && currentActiveCustomerId) {
            LocalDB.addTransaction(currentActiveCustomerId, type, amount, desc);
            closeModal('transactionModal', 'transactionModalContent');
            renderLedgerTransactions();
        }
    });

    // Initial render
    renderDashboard();
});
