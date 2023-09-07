<?php

namespace Database\Seeders;

use App\Models\OrderCount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $points = [
            [
                'user_id' => '2',
                'pointOrder' => '200',
            ],
            [
                'user_id' => '3',
                'pointOrder' => '250',
            ],
            [
                'user_id' => '4',
                'pointOrder' => '300',
            ],
            [
                'user_id' => '5',
                'pointOrder' => '350',
            ]
        ];

        OrderCount::insert($points);
    }
}
