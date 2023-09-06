<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'user_id' => '2',
                'transactionNo' => 'LAU0518827418TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],[
                'user_id' => '2',
                'transactionNo' => 'LAU0518827518TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
            [
                'user_id' => '2',
                'transactionNo' => 'LAU0518827118TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
            [
                'user_id' => '3',
                'transactionNo' => 'LAU0518555518TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
            [
                'user_id' => '3',
                'transactionNo' => 'LAU0518811518TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
            [
                'user_id' => '3',
                'transactionNo' => 'LAU0528827118TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
            [
                'user_id' => '4',
                'transactionNo' => 'LAU0518826666TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
            [
                'user_id' => '4',
                'transactionNo' => 'LAU0555557518TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
            [
                'user_id' => '4',
                'transactionNo' => 'LAU4444827118TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
            [
                'user_id' => '5',
                'transactionNo' => 'LAU0000027418TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
            [
                'user_id' => '5',
                'transactionNo' => 'LAU0518800008TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
            [
                'user_id' => '5',
                'transactionNo' => 'LAU050082008TRX',
                'statusOrder' => 'Menunggu Verifikasi',
            ],
        ];
        DB::table('orders')->insert($orders);
    }
}
