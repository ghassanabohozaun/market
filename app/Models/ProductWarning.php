<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductWarning extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'product_warnings';
    protected $fillable = ['product_id', 'description'];

    public array $translatable = ['description'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
