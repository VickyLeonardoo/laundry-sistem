<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            [
                'nama' => 'Pakaian',
                'satuan' => 'KG',
                'harga' => '6000',
            ],
            [
                'nama' => 'Karpet',
                'satuan' => 'Item',
                'harga' => '40000',
            ],
        ];
        DB::table('jenis_barangs')->insert($jenis);
    }
}
