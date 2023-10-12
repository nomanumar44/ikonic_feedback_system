<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 'Admin',
            ],
            [
                'name' => 'User1',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('user123'),
                'role' => 'User',
            ],
            [
                'name' => 'User2',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('user123'),
                'role' => 'User',
            ],
            [
                'name' => 'User3',
                'email' => 'user3@gmail.com',
                'password' => bcrypt('user123'),
                'role' => 'User',
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
