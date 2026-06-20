<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\AdminRepository;
use App\Utils\ImageManagerUtils;
use Illuminate\Support\Facades\Cache;

class AdminService
{
    /**
     * Create a new class instance.
     */

    protected $adminRepository, $imageManagerUtils;

    // __construct
    public function __construct(AdminRepository $adminRepository, ImageManagerUtils $imageManagerUtils)
    {
        $this->adminRepository = $adminRepository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    // get Admin
    public function getAdmin($id)
    {
        $admin = $this->adminRepository->getAdmin($id);
        if (!$admin) {
            return false;
            //abort(404);
        }
        return $admin;
    }

    // get admins
    public function getAdmins($filters = [])
    {
        return $this->adminRepository->getAdmins($filters);
    }

    // store admin
    public function storeAdmin($data)
    {
        if (array_key_exists('photo', $data) && $data['photo'] != null) {
            $data['photo'] = $this->imageManagerUtils->saveResizeImage($data['photo'], 'adminsPhotos', 100, 100);
        }

        $admin = $this->adminRepository->storeAdmin($data);
        if (!$admin) {
            return false;
        }
        return $admin;
    }

    //update admin
    public function updateAdmin($data)
    {
        $admin = $this->adminRepository->getAdmin($data['id']);
        if (!$admin) {
            return false;
        }

        $data['password'] = empty($data['password']) ? $admin->password : $data['password'];

        if (array_key_exists('photo', $data) && $data['photo'] != null) {
            $this->imageManagerUtils->removeImageFromLocal($admin->photo, 'adminsPhotos');
            $data['photo'] = $this->imageManagerUtils->saveResizeImage($data['photo'], 'adminsPhotos', 100, 100);
        } else {
            if ($admin->photo != null) {
                $data['photo'] = $admin->photo;
            } else {
                $data['photo'] = '';
            }
        }

        $updated = $this->adminRepository->updateAdmin($admin, $data);
        if (!$updated) {
            return false;
        }
        return $admin;
    }
    public function destroyAdmin($id)
    {
        $admin = $this->adminRepository->getAdmin($id);
        if (!$admin) {
            return false;
        }
        if (!empty($admin->photo)) {
            $this->imageManagerUtils->removeImageFromLocal($admin->photo, 'adminsPhotos');
        }

        // Check for restrictive relations
        if (method_exists($admin, 'checkRestrictiveRelations')) {
            $admin->checkRestrictiveRelations();
        }

        $admin = $this->adminRepository->destroyAdmin($admin);
        if (!$admin) {
            return false;
        }
        return $admin;
    }

    // change status admin
    public function changeStatusAdmin($id, $status)
    {
        $admin = $this->adminRepository->getAdmin($id);
        if (!$admin) {
            return false;
        }

        $admin = $this->adminRepository->changeStatusAdmin($admin, $status);
        if (!$admin) {
            return false;
        }
        return $admin;
    }


}
