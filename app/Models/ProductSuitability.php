<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductSuitability extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'product_suitabilities';
    protected $fillable = ['product_id', 'title', 'description'];

    public array $translatable = ['title', 'description'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
