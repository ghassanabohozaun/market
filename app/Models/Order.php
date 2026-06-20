<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable = ['user_id', 'user_name', 'user_phone', 'user_email', 'price', 'shipping_price', 'total_price', 'note', 'status', 'country', 'governorate', 'city', 'street'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
