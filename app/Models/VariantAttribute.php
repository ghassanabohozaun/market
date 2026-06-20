<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariantAttribute extends Model
{
    protected $table = 'variant_attributes';
    protected $fillable = ['product_variant_id', 'attribute_value_id'];

    // relation
    public function productVariant(){
        return $this->belongsTo(ProductVariant::class);
    }

    public function attributeValue(){
        return $this->belongsTo(AttributeValue::class);
    }
}
