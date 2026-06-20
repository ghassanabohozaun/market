<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\CanBeDeleted;

class City extends Model
{
    use SoftDeletes, HasTranslations, CanBeDeleted;
    protected $table = 'cities';
    protected $fillable = ['name', 'governorate_id', 'status'];
    public $timestamps = false;
    public array $translatable = ['name'];

    // relations
    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    /**
     * Override trait method to check if this city has associated orders.
     * The orders table stores city/governorate names as strings, so we check translated names.
     */
    public function checkRestrictiveRelations()
    {
        $names = array_values($this->getTranslations('name') ?: []);
        if (!empty($names)) {
            $hasOrders = \App\Models\Order::whereIn('city', $names)
                ->orWhereIn('governorate', $names)
                ->exists();
            if ($hasOrders) {
                throw new \App\Exceptions\DeleteRestrictionException(__('addresses.city_restricted_deletion'));
            }
        }
        return true;
    }

}
