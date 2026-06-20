<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\LoginRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiResponse;

    // login
    public function login(LoginRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return $this->ApiResponse(null, false, __('admins.admin_not_found'), 404);
        }

        if (!Hash::check($request->password, $admin->password)) {
            return $this->ApiResponse(null, false, __('admins.invalid_password'), 401);
        }

        $token = $admin->createToken('admin_auth_token', ['*'], now()->addMonth())->plainTextToken;

        $data = [
            'admin' => new AdminResource($admin->load(['role'])),
            'token' => $token,
        ];

        return $this->ApiResponse($data, true, __('admins.admin_logged_in_successfully'), 200);
    }

    // logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->ApiResponse(null, true, __('admins.logout_success'), 200);
    }
}
