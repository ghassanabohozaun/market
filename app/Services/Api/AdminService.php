<?php

namespace App\Services\Api;

use App\Repositories\Api\AdminRepository;

class AdminService
{
    protected $adminRepository;
    //Create a new class instance.
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    // get admins
    public function getAdmins()
    {
        return $this->adminRepository->getAdmins();
    }
}
