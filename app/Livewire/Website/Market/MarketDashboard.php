<?php

namespace App\Livewire\Website\Market;

use App\Models\MarketCustomer;
use App\Models\MarketTransaction;
use Carbon\Carbon;
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
        $this->activeCustomer = MarketCustomer::create([
            'name' => $this->newCustomerName,
            'phone' => $this->newCustomerPhone,
        ]);

        $this->newCustomerName = '';
        $this->newCustomerPhone = '';
        $this->showNewCustomerModal = false;

        $this->dispatch('toast', [
            'title' => __('market.success'),
            'message' => __('market.customer_added') . $this->activeCustomer->name,
            'type' => 'success'
        ]);

        $this->dispatch('open-modal', id: 'ledgerModal');
    }

    public function openLedger($customerId)
    {
        $this->activeCustomer = MarketCustomer::find($customerId);
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
        $tx = MarketTransaction::find($id);
        if (!$tx) return;

        $this->editingTxId = $tx->id;
        $this->txType = $tx->type;
        $this->txAmount = $tx->amount;
        $this->txDescription = $tx->description;
        $this->dispatch('open-modal', id: 'transactionModal');
    }

    public function deleteTransaction($id)
    {
        $tx = MarketTransaction::find($id);
        if ($tx) {
            $tx->delete();
            $this->activeCustomer->refresh();
            $this->dispatch('toast', [
                'title' => __('market.deleted'),
                'message' => __('market.transaction_deleted'),
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
            $tx = MarketTransaction::find($this->editingTxId);
            if ($tx) {
                $tx->update([
                    'type' => $this->txType,
                    'amount' => $this->txAmount,
                    'description' => $this->txDescription ?? ($this->txType === 'debt' ? __('market.debt') : __('market.payment')),
                ]);
                
                $this->dispatch('toast', [
                    'title' => __('market.updated'),
                    'message' => __('market.transaction_updated'),
                    'type' => 'info'
                ]);
            }
        } else {
            MarketTransaction::create([
                'market_customer_id' => $this->activeCustomer->id,
                'type' => $this->txType,
                'amount' => $this->txAmount,
                'description' => $this->txDescription ?? ($this->txType === 'debt' ? __('market.debt') : __('market.payment')),
            ]);

            $this->dispatch('toast', [
                'title' => __('market.registered'),
                'message' => $this->txType === 'debt' ? __('market.debt_registered') : __('market.payment_registered'),
                'type' => 'success'
            ]);
        }

        $this->activeCustomer->refresh();

        $this->dispatch('close-modal', id: 'transactionModal');
    }

    public function render()
    {
        $query = MarketCustomer::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->filter === 'debt') {
            $query->where('balance', '>', 0);
        } elseif ($this->filter === 'paid') {
            $query->where('balance', '<=', 0);
        }

        $customers = $query->latest()->paginate(20);

        $totalDebt = MarketCustomer::where('balance', '>', 0)->sum('balance');
        $todayCollections = MarketTransaction::where('type', 'payment')
            ->whereDate('created_at', Carbon::today())
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
