<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => [
                    'en' => 'User',
                    'ar' => 'المستخدم',
                ],
                'password' => bcrypt('123456'),
                'email' => 'user@user.com',
                'mobile' => fake()->phoneNumber(),
                'status' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
