<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promos = [
            [
                'nama' => 'Promo 5%',
                'deskripsi' => 'Diskon 5% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '5',
                'persyaratan' => '50',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 10%',
                'deskripsi' => 'Diskon 10% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '10',
                'persyaratan' => '100',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 15%',
                'deskripsi' => 'Diskon 15% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '15',
                'persyaratan' => '150',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 25%',
                'deskripsi' => 'Diskon 25% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '25',
                'persyaratan' => '250',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 30%',
                'deskripsi' => 'Diskon 30% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '30',
                'persyaratan' => '300',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 35%',
                'deskripsi' => 'Diskon 35% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '35',
                'persyaratan' => '350',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 40%',
                'deskripsi' => 'Diskon 40% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '40',
                'persyaratan' => '400',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 45%',
                'deskripsi' => 'Diskon 45% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '45',
                'persyaratan' => '450',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 50%',
                'deskripsi' => 'Diskon 50% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '50',
                'persyaratan' => '500',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 55%',
                'deskripsi' => 'Diskon 55% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '55',
                'persyaratan' => '550',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 70%',
                'deskripsi' => 'Diskon 70% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '70',
                'persyaratan' => '700',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 80%',
                'deskripsi' => 'Diskon 80% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '80',
                'persyaratan' => '800',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 90%',
                'deskripsi' => 'Diskon 90% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '90',
                'persyaratan' => '900',
                'status' => 'active',
            ],
            [
                'nama' => 'Promo 100%',
                'deskripsi' => 'Diskon 100% Untuk Semua Jenis Laundryan',
                'tipeDiscount' => 'percent',
                'nominal' => '100',
                'persyaratan' => '1000',
                'status' => 'active',
            ],
        ];
        DB::table('discounts')->insert($promos);
    }
}
