<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes ,HasFactory;
    protected $table = 'coupons';
    protected $fillable = ['code', 'discount_percentage', 'start_date', 'end_date', 'limit', 'time_used', 'is_active'];

    // accessores
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i a');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i a');
    }

    // scopes
    public function scopeValid($qurey)
    {
        return $qurey->where('is_active', 1)->where('time_used', '<', 'limit')->where('end_date', '>', now());
    }
    public function scopeInvalid($query)
    {
        return $query->where('is_active', 0)->orWhere('time_used', '>=', 'limit')->orWhere('end_date', '<', now());
    }

    public function couponIsValid()
    {
        return $this->is_active == 1 && $this->time_used < $this->limit && $this->end_date > now();
    }
}
