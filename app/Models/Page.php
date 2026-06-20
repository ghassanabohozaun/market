<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use SoftDeletes, HasTranslations;

    protected $table = 'pages';
    protected $fillable = ['title', 'slug', 'details', 'photo', 'status'];

    protected array $translatable = ['title', 'details', 'slug'];

    // accessoreies
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y h:i A');
    }

    // scopes
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
