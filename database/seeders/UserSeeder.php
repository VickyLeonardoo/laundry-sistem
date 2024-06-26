<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('123'),
                'noHp' => '081275528611',
                'role' => '0',
                'is_active' => '1',
            ],
            [
                'name' => 'User',
                'email' => 'user1@example.com',
                'password' => bcrypt('123'),
                'noHp' => '081275528621',
                'role' => '1',
                'is_active' => '1',
            ],
            [
                'name' => 'User',
                'email' => 'user2@example.com',
                'password' => bcrypt('123'),
                'noHp' => '081275528621',
                'role' => '1',
                'is_active' => '1',
            ],
            [
                'name' => 'User',
                'email' => 'user3@example.com',
                'password' => bcrypt('123'),
                'noHp' => '081275528621',
                'role' => '1',
                'is_active' => '1',
            ],
            [
                'name' => 'User',
                'email' => 'user4@example.com',
                'password' => bcrypt('123'),
                'noHp' => '081275528621',
                'role' => '1',
                'is_active' => '1',
            ],

        ];
        DB::table('users')->insert($users);
    }
}
