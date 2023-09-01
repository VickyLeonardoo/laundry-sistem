<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('trackingNo');
            $table->enum('statusOrder',['Menunggu Verifikasi','Diproses','Selesai']);
            $table->enum('statusPembayaran',['Menunggu Pembayaran','Terbayar']);
            $table->enum('modePembayaran',['Cash On Deal','Online']);
            $table->foreignId('disocunt_id')->references('id')->on('discounts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
