<?php

namespace App\Repositories\Api;

use App\Models\Role;

class RoleRepository
{
    // roles
    public function roles()
    {
        return Role::latest()->get();
    }
}
