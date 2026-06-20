<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketCustomer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'balance'];

    public function transactions()
    {
        return $this->hasMany(MarketTransaction::class)->latest();
    }
}
