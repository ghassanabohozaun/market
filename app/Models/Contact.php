<?php

namespace App\Models;

use App\Traits\QueryTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes, QueryTrait;
    protected $table = 'contacts';
    protected $fillable = ['user_id', 'name', 'email', 'phone', 'subject', 'message', 'is_read', 'replay', 'is_replay', 'is_star'];

    // relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // accessories
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y h:i A');
    }
}
