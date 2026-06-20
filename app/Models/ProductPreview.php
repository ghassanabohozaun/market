<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ProductPreview extends Model
{
    use SoftDeletes, HasTranslations;
    protected $table = 'product_previews';
    protected $fillable = ['comment', 'product_id', 'user_id'];

    // translatable
    public array $translatable = ['comment'];

    // relations
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
