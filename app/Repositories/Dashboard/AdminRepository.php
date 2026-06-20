<?php

namespace App\Repositories\Dashboard;

use App\Models\Admin;

class AdminRepository
{

    // get admin
    public function getAdmin($id)
    {
        $admin = Admin::find($id);
        return $admin;
    }

    // get admins
    public function getAdmins($filters = [])
    {
        $admins = Admin::orderByDesc('created_at')
            ->when(!empty($filters['search_term']), function ($query) use ($filters) {
                $query->where(function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['search_term'] . '%')
                        ->orWhere('email', 'like', '%' . $filters['search_term'] . '%');
                });
            })
            ->when(!empty($filters['role_id']), function ($query) use ($filters) {
                $query->where('role_id', $filters['role_id']);
            })
            ->when(isset($filters['status']) && $filters['status'] !== '', function ($query) use ($filters) {
                $query->where('status', (int) $filters['status']);
            })
            ->select('id', 'name', 'email', 'password', 'status', 'role_id', 'created_at', 'photo')
            ->paginate(10);
        return $admins;
    }

    // store admin

    public function storeAdmin($data)
    {
        return Admin::create($data);
    }

    // update admin
    public function updateAdmin($admin, $data)
    {
        return $admin->update($data);
    }

    // destroy admin
    public function destroyAdmin($admin)
    {
        return $admin->forceDelete();
    }

    // change status

    public function changeStatusAdmin($admin, $status)
    {
        $admin->update([
            'status' => $status,
        ]);
        return $admin;
    }


}
