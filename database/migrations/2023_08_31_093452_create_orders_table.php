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
            $table->id()->startingValue(15);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('transactionNo');
            $table->enum('statusOrder',['Menunggu Verifikasi','Diproses','Selesai'])->defaut('Menunggu Verifikasi');
            $table->enum('statusPembayaran',['Menunggu Pembayaran','Terbayar'])->nullable();
            $table->enum('modePembayaran',['Cash On Deal','Online'])->nullable();
            $table->enum('is_discount',['yes','no'])->default('no');
            $table->enum('is_taken',['yes','no'])->default('no');
            $table->foreignId('discount_id')->nullable();
            $table->timestamp('tglOrder')->nullable();
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
