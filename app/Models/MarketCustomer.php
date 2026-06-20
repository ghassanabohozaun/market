<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Dashboard\CanBeDeleted;

class MarketCustomer extends Model
{
    use HasFactory, CanBeDeleted;

    protected $fillable = ['name', 'phone', 'balance'];

    public function transactions()
    {
        return $this->hasMany(MarketTransaction::class)->latest();
    }

    public function checkRestrictiveRelations()
    {
        if ($this->transactions()->count() > 0) {
            throw new \App\Exceptions\DeleteRestrictionException(__('market.customer_has_transactions'));
        }

        return true;
    }
}
