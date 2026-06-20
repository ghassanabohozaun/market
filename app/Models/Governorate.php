<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\CanBeDeleted;

class Governorate extends Model
{
    use SoftDeletes, HasTranslations, CanBeDeleted;

    protected $restrictiveRelations = [
        'cities' => 'addresses.governorate_restricted_deletion',
    ];

    protected $table = 'governorates';
    protected $fillable = ['name', 'status', 'country_id'];
    public $timestamps = false;
    public array $translatable = ['name'];

    // relation
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'governorate_id');
    }

    // accsessores
    // public function getStatusAttribute($status)
    // {
    //     return $status == 1 ? 'on' : '';
    // }
}
