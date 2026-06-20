<?php

namespace App\Models;

use App\Traits\QueryTrait;
use App\Traits\Dashboard\CanBeDeleted;
use App\Exceptions\DeleteRestrictionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Attribute extends Model
{
    use SoftDeletes, HasTranslations, QueryTrait, CanBeDeleted;

    protected $table = 'attributes';
    protected $fillable = ['name', 'status'];

    public array $translatable = ['name'];

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

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    /**
     * Override trait: block deletion if any value is used in product variants.
     */
    public function checkRestrictiveRelations()
    {
        $valueIds = $this->values()->pluck('id');

        if ($valueIds->isNotEmpty()) {
            $usedInVariants = DB::table('variant_attributes')
                ->whereIn('attribute_value_id', $valueIds)
                ->exists();

            if ($usedInVariants) {
                throw new DeleteRestrictionException(__('attributes.attribute_has_product_variants_restricted_deletion'));
            }
        }

        return true;
    }
}
