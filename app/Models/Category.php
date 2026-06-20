<?php

namespace App\Models;

use App\Traits\QueryTrait;
use App\Traits\Dashboard\CanBeDeleted;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use SoftDeletes, HasTranslations, QueryTrait, CanBeDeleted;

    protected $restrictiveRelations = [
        'children'  => 'categories.category_has_children_restricted_deletion',
        'products'  => 'categories.category_has_products_restricted_deletion',
    ];

    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'status', 'parent', 'icon'];

    // translation
    public array $translatable = ['name', 'slug'];


    public function parentRelation()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    // scopes
    public function scopeActive($query)
    {
        return $query->whereStatus(1);
    }
    public function scopeInactive($query)
    {
        return $query->whereStatus(0);
    }

    // accessories
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y h:i A');
    }
}
