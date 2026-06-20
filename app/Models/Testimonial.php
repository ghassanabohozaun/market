<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasTranslations;

    protected $fillable = ['name', 'title', 'content', 'rating', 'image', 'status'];

    public array $translatable = ['name', 'title', 'content'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
