<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ChangePasswordRequest;
use App\Models\Admin;
use App\Services\Dashboard\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // construct
    protected $profileService;
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    // index
    public function index()
    {
        $title = __('navbar.my_profile');
        return view('dashboard.profile.index', compact('title'));
    }

    // chane password
    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->except(['_token', '_method']);
        $admin = $this->profileService->changePassword($data);
        if (!$admin) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 201);
    }
}
