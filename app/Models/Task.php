<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'title', 'is_completed'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
