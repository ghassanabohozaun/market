<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Lookbook extends Model
{
    use HasTranslations;

    protected $fillable = ['title', 'subtitle', 'description', 'btn_text', 'btn_link', 'image', 'status'];

    public array $translatable = ['title', 'subtitle', 'description', 'btn_text'];

    // scopes
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
