<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'product_id', 'product_variant_id', 'product_name', 'product_desc', 
    'product_quantity', 'product_price', 'data'];
}
