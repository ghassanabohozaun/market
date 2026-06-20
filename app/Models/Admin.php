<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\CanBeDeleted;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasTranslations, HasApiTokens, CanBeDeleted;

    protected $restrictiveRelations = [
        'tasks' => 'admins.admin_have_tasks',
    ];

    protected $table = 'admins';

    // fillable
    protected $fillable = ['name', 'email', 'password', 'role_id', 'status', 'photo'];

    public array $translatable = ['name'];

    // hidden
    protected $hidden = ['password', 'remember_token'];

    // Get the attributes that should be cast.
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // relations
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'admin_id');
    }

    public function getCreatedAtAttribute($value)
    {
        if (request()->wantsJson()) {
            return $value;
        }
        return Carbon::parse($value)->format('d/m/Y h:i A');
    }

    // has ability permission
    public function hasAbility($permissions)
    {
        $role = $this->role;
        if (!$role) {
            return false;
        }
        foreach ($role->permissions as $permission) {
            if (is_array($permissions) && in_array($permission, $permissions)) {
                return true;
            } elseif (is_string($permissions) && strcmp($permissions, $permission) == 0) {
                return true;
            }
        }
        return false;
    }

    // scopes
    public function scopeActive($query)
    {
        return $query->whereStatus(1);
    }
    public function scopeInactive($query)
    {
        return $query->whereStatus(0);
    }
}
