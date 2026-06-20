<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use SoftDeletes, HasTranslations;
    protected $table = 'sliders';
    protected $fillable = ['title', 'subtitle', 'details', 'url', 'order', 'details_status', 'button_status', 'status', 'photo'];

    public array $translatable = ['title', 'subtitle', 'details', 'url'];

    // accessories
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
