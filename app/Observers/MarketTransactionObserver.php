<?php

namespace App\Observers;

use App\Models\MarketTransaction;

class MarketTransactionObserver
{
    /**
     * Handle the MarketTransaction "created" event.
     */
    public function created(MarketTransaction $marketTransaction): void
    {
        $this->recalculateBalance($marketTransaction->customer);
    }

    /**
     * Handle the MarketTransaction "updated" event.
     */
    public function updated(MarketTransaction $marketTransaction): void
    {
        $this->recalculateBalance($marketTransaction->customer);
    }

    /**
     * Handle the MarketTransaction "deleted" event.
     */
    public function deleted(MarketTransaction $marketTransaction): void
    {
        $this->recalculateBalance($marketTransaction->customer);
    }

    /**
     * Handle the MarketTransaction "restored" event.
     */
    public function restored(MarketTransaction $marketTransaction): void
    {
        $this->recalculateBalance($marketTransaction->customer);
    }

    /**
     * Handle the MarketTransaction "force deleted" event.
     */
    public function forceDeleted(MarketTransaction $marketTransaction): void
    {
        $this->recalculateBalance($marketTransaction->customer);
    }

    protected function recalculateBalance($customer)
    {
        if (!$customer) return;

        $debts = $customer->transactions()->where('type', 'debt')->sum('amount');
        $payments = $customer->transactions()->where('type', 'payment')->sum('amount');
        
        $customer->updateQuietly(['balance' => $debts - $payments]);
    }
}
