<?php

namespace App\Livewire\Website\Market;

use Livewire\Component;

class MarketDashboard extends Component
{
    use \Livewire\WithPagination;

    // Search & Filter
    public $search = '';
    public $filter = 'all'; // all, debt, paid

    // New Customer
    public $newCustomerName = '';
    public $newCustomerPhone = '';

    // Ledger Modal State
    public $activeCustomer = null;
    public $ledgerPage = 1;
    public $perPage = 15;

    // New / Edit Transaction
    public $txType = 'debt';
    public $txAmount = '';
    public $txDescription = '';
    public $editingTxId = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function addCustomer()
    {
        $this->validate([
            'newCustomerName' => 'required|string|max:255',
            'newCustomerPhone' => 'nullable|string|max:10',
        ]);
        $this->activeCustomer = \App\Models\MarketCustomer::create([
            'name' => $this->newCustomerName,
            'phone' => $this->newCustomerPhone,
        ]);

        $this->newCustomerName = '';
        $this->newCustomerPhone = '';
        $this->showNewCustomerModal = false;

        $this->dispatch('toast', [
            'title' => 'تم بنجاح',
            'message' => 'تمت إضافة العميل ' . $this->activeCustomer->name,
            'type' => 'success'
        ]);

        $this->dispatch('open-modal', id: 'ledgerModal');
    }

    public function openLedger($customerId)
    {
        $this->activeCustomer = \App\Models\MarketCustomer::find($customerId);
        $this->ledgerPage = 1;
        $this->dispatch('open-modal', id: 'ledgerModal');
    }

    public function loadMoreLedger()
    {
        $this->ledgerPage++;
    }

    public function openTxModal($type)
    {
        $this->txType = $type;
        $this->editingTxId = null;
        $this->reset(['txAmount', 'txDescription']);
        $this->dispatch('open-modal', id: 'transactionModal');
    }

    public function editTransaction($id)
    {
        $tx = \App\Models\MarketTransaction::find($id);
        if (!$tx) return;

        $this->editingTxId = $tx->id;
        $this->txType = $tx->type;
        $this->txAmount = $tx->amount;
        $this->txDescription = $tx->description;
        $this->dispatch('open-modal', id: 'transactionModal');
    }

    public function deleteTransaction($id)
    {
        $tx = \App\Models\MarketTransaction::find($id);
        if ($tx) {
            $tx->delete();
            $this->activeCustomer->refresh();
            $this->dispatch('toast', [
                'title' => 'تم الحذف',
                'message' => 'تم حذف الحركة بنجاح',
                'type' => 'error'
            ]);
        }
    }

    public function addTransaction()
    {
        $this->validate([
            'txAmount' => 'required|numeric|min:0.1',
            'txType' => 'required|in:debt,payment',
            'txDescription' => 'nullable|string|max:255',
        ]);

        if (!$this->activeCustomer) return;

        if ($this->editingTxId) {
            $tx = \App\Models\MarketTransaction::find($this->editingTxId);
            if ($tx) {
                $tx->update([
                    'type' => $this->txType,
                    'amount' => $this->txAmount,
                    'description' => $this->txDescription ?? ($this->txType === 'debt' ? 'دين' : 'دفعة'),
                ]);
                
                $this->dispatch('toast', [
                    'title' => 'تم التحديث',
                    'message' => 'تم تعديل الحركة بنجاح',
                    'type' => 'info'
                ]);
            }
        } else {
            \App\Models\MarketTransaction::create([
                'market_customer_id' => $this->activeCustomer->id,
                'type' => $this->txType,
                'amount' => $this->txAmount,
                'description' => $this->txDescription ?? ($this->txType === 'debt' ? 'دين' : 'دفعة'),
            ]);

            $this->dispatch('toast', [
                'title' => 'تم التسجيل',
                'message' => 'تم تسجيل ' . ($this->txType === 'debt' ? 'الدين' : 'الدفعة') . ' بنجاح',
                'type' => 'success'
            ]);
        }

        $this->activeCustomer->refresh();

        $this->dispatch('close-modal', id: 'transactionModal');
    }

    public function render()
    {
        $query = \App\Models\MarketCustomer::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->filter === 'debt') {
            $query->where('balance', '>', 0);
        } elseif ($this->filter === 'paid') {
            $query->where('balance', '<=', 0);
        }

        $customers = $query->latest()->paginate(20);

        $totalDebt = \App\Models\MarketCustomer::where('balance', '>', 0)->sum('balance');
        $todayCollections = \App\Models\MarketTransaction::where('type', 'payment')
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->sum('amount');

        $ledgerTransactions = [];
        $totalLedgerTransactions = 0;
        if ($this->activeCustomer) {
            $ledgerTransactions = $this->activeCustomer->transactions()
                ->latest()
                ->take($this->ledgerPage * $this->perPage)
                ->get();
            $totalLedgerTransactions = $this->activeCustomer->transactions()->count();
        }

        return view('livewire.website.market.market-dashboard', [
            'customers' => $customers,
            'totalDebt' => $totalDebt,
            'todayCollections' => $todayCollections,
            'ledgerTransactions' => $ledgerTransactions,
            'totalLedgerTransactions' => $totalLedgerTransactions,
        ]);
    }
}
