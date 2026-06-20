<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiResponse;

    // login
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->ApiResponse(null, false, __('users.user_not_found'), 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->ApiResponse(null, false, __('users.invalid_password'), 401);
        }

        $token = $user->createToken('user-token', ['*'], now()->addMonth())->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->ApiResponse($data, true, __('users.user_logged_in_successfully'), 200);
    }


    // logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->ApiResponse(null,true, __('users.logout_success'), 200);
    }
}
