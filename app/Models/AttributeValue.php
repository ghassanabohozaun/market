<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = ['attribute_id', 'value'];
    
    public array $translatable = ['value'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
