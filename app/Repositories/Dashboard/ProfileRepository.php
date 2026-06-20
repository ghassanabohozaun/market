<?php

namespace App\Repositories\Dashboard;

class ProfileRepository
{

    // change password
    public function changePassword($data)
    {
        $admin = admin()->user();
        $admin->update([
            'password' => $data['password']
        ]);

        // Re-authenticate so the session doesn't become invalidated by the changed password hash
        admin()->login($admin);

        return $admin;
    }

}
