<?php

namespace App\Repositories\Api;

use App\Models\Admin;

class AdminRepository
{

    // get admins
    public function  getAdmins() {

        return Admin::latest()->active()->get();
    }
}
