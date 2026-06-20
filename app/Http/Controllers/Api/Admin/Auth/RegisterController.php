<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\RegisterRequest;
use App\Http\Resources\AdminResource;
use App\Services\Dashboard\AdminService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use ApiResponse;
    protected $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    // register
    public function register(RegisterRequest $request)
    {
        $admin = $this->adminService->storeAdmin($request->validated());
        $token = $admin->createToken('admin_auth_token', ['*'], now()->addWeek())->plainTextToken;
        $data = [
            'admin' => new AdminResource($admin->load('role')),
            'token' => $token,
        ];

        return $this->ApiResponse($data, true, __('general.add_success_message'), 200);
    }
}
