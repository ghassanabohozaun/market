<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Services\Api\AdminService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use ApiResponse;

    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function admins()
    {
        $admins = $this->adminService->getAdmins();
        $data = ['admins' => AdminResource::collection($admins)];
        return $this->ApiResponse($data, true, __('general.data_fetch_successfully'), 200);
    }
}
