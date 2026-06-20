<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\ProfileRepository;

class ProfileService
{
    protected $profileRepository;
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    // change password
    public function changePassword($data)
    {
        $admin = $this->profileRepository->changePassword($data);
        if (!$admin) {
            return false;
        }
        return true;
    }
}
