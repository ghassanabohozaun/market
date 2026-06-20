<?php

namespace App\Services\Api;

use App\Repositories\Api\RoleRepository;

class RoleService
{
    protected $roleRepository;

    //__construct
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    // roles
    public function roles()  {

        return $this->roleRepository->roles();

    }
}
