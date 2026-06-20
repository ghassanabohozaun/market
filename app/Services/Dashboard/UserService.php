<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\UserRepository;
use Yajra\DataTables\Facades\DataTables;

class UserService
{
    protected $userRepository;
    //__construct
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // get user
    public function getUser($id)
    {
        $user = $this->userRepository->getUser($id);
        if (!$user) {
            return false;
        }
        return $user;
    }

    // get users
    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }


    // store user
    public function storeUser($data)
    {
        $user = $this->userRepository->storeUser($data);
        if (!$user) {
            return false;
        }
        return $user;
    }

    // update user
    public function updateUser($user, $data)
    {
        $user = self::getUser($data['id']);

        $user = $this->userRepository->updateUser($user, $data);
        if (!$user) {
            return false;
        }
        return $user;
    }

    // destroy user
    public function destroyUser($id)
    {
        $user = self::getUser($id);

        $user = $this->userRepository->destroyUser($user);
        if (!$user) {
            return false;
        }
        return $user;
    }

    // change status
    public function changeStatus($id, $status)
    {
        $user = self::getUser($id);
        $user = $this->userRepository->changeStatus($user, $status);
        if (!$user) {
            return false;
        }
        return $user;
    }
}
