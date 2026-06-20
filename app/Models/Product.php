<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\FuncCall;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\HasInventory;
use App\Traits\Dashboard\CanBeDeleted;
use PDO;

class Product extends Model
{
    use SoftDeletes, HasFactory, HasTranslations, Sluggable, HasInventory, CanBeDeleted;
    protected $table = 'products';
    protected $fillable = ['name', 'slug', 'small_desc', 'desc', 'status', 'sku',
     'available_for', 'views', 'has_variants', 'price', 'has_discount', 'discount',
    'start_discount', 'end_discount', 'manage_stock', 'quantity', 'available_in_stock',
    'category_id', 'brand_id', 'active_ingredient_title', 'active_ingredient_desc',
    'specifications'];

    protected $casts = [
        'specifications' => 'array',
    ];

    // sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    // translatable
    public array $translatable = ['name', 'small_desc', 'desc', 'active_ingredient_title', 
    'active_ingredient_desc'];

    // functions
    public function getPriceAfterDiscount()
    {
        if ($this->has_discount) {
            return $this->price - $this->discount;
        }

        return $this->price;
    }
    // relations
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function productPreivews()
    {
        return $this->hasMany(ProductPreview::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function benefits()
    {
        return $this->hasMany(ProductBenefit::class, 'product_id');
    }

    public function ingredients()
    {
        return $this->hasMany(ProductIngredient::class, 'product_id');
    }

    public function usages()
    {
        return $this->hasMany(ProductUsage::class, 'product_id');
    }

    public function warnings()
    {
        return $this->hasMany(ProductWarning::class, 'product_id');
    }

    public function expectedResults()
    {
        return $this->hasMany(ProductExpectedResult::class, 'product_id');
    }

    public function suitabilities()
    {
        return $this->hasMany(ProductSuitability::class, 'product_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    /**
     * Override trait method to check if this product has associated orders.
     */
    public function checkRestrictiveRelations()
    {
        if ($this->orderItems()->exists()) {
            throw new \App\Exceptions\DeleteRestrictionException(__('products.product_has_orders_restricted_deletion'));
        }
        return true;
    }

    // function
    public function isSimple()
    {
        return !$this->has_variants;
    }

    //accessories

    public function priceAttributeFunction()
    {
        return $this->has_variants == 0 ? number_format($this->price, 2) : __('products.has_variants');
    }
    public function quantityAttributeFunction()
    {
        return $this->has_variants == 0 ? $this->quantity : __('products.has_variants');
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y h:i A');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y h:i A');
    }

    public function getFirstImagePathAttribute()
    {
        $firstImage = $this->images->first();
        if ($firstImage) {
            return asset('uploads/products/' . $firstImage->file_name);
        }
        return asset('assets/website/images/prod1.png'); // Using prod1 as a fallback placeholder based on the current template
    }

    //scopes
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
}
