<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Services\Api\RoleService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    use ApiResponse;

    protected $roleService;

    //__construct
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    //roles
    public function roles()
    {
        $roles = $this->roleService->roles();
        $data = ['roles' => RoleResource::collection($roles)];
        return $this->ApiResponse($data, true, __('general.fetch_success'), 200);
    }
}
