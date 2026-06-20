<?php

namespace App\Models;

use App\Traits\QueryTrait;
use App\Traits\Dashboard\CanBeDeleted;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use SoftDeletes, HasTranslations, QueryTrait, CanBeDeleted;
    
    protected $restrictiveRelations = [
        'products' => 'tags.tag_has_products_restricted_deletion',
    ];

    protected $table = 'tags';
    protected $fillable = ['name', 'slug', 'status'];

    public array $translatable = ['name', 'slug'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tags', 'tag_id', 'product_id');
    }
    public function scopeActive($query)
    {
        return $query->whereStatus(1);
    }

    public function scopeInactive($query)
    {
        return $query->whereStatus(0);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y h:i A');
    }
}
