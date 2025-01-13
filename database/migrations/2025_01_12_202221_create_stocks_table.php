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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('product'); // Nama barang
            $table->date('expired_date'); // Tanggal kedaluwarsa
            $table->integer('stock_in')->default(0); // Total barang masuk
            $table->integer('stock_out')->default(0); // Total barang keluar
            $table->integer('stock_now')->default(0); // Stok saat ini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
