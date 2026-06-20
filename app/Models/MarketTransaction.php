<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\MarketTransactionObserver;

#[ObservedBy(MarketTransactionObserver::class)]
class MarketTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['market_customer_id', 'type', 'amount', 'description'];

    public function customer()
    {
        return $this->belongsTo(MarketCustomer::class, 'market_customer_id');
    }
}
