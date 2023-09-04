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
                'name' => 'Pikimoy',
                'email' => 'pikimoy@example.com',
                'password' => bcrypt('12345'),
                'noHp' => '081275528621',
                'role' => '1',
                'is_active' => '1',
            ],
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('12345'),
                'noHp' => '081275528611',
                'role' => '0',
                'is_active' => '1',
            ]
        ];
        DB::table('users')->insert($users);
    }
}
