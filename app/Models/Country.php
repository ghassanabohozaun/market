<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\CanBeDeleted;

class Country extends Model
{
    use SoftDeletes, HasTranslations, CanBeDeleted;
    protected $table = 'countries';
    protected $fillable = ['name', 'phone_code', 'flag_code', 'status'];

    public array $translatable = ['name'];

    // relations
    public function governorates()
    {
        return $this->hasMany(Governorate::class, 'country_id');
    }

    public function cities()
    {
        return $this->hasManyThrough(City::class, Governorate::class);
    }

    /**
     * Override trait method to check if this country has governorates or associated orders.
     */
    public function checkRestrictiveRelations()
    {
        // 1. Check if has governorates
        if ($this->governorates()->count() > 0) {
            throw new \App\Exceptions\DeleteRestrictionException(__('addresses.country_restricted_deletion'));
        }

        return true;
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

    // // accessories
    // public function getStatusAttribute($status)
    // {
    //     return $status == 1 ? 'on' : '';
    // }
}
