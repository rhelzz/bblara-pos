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
        Schema::create('product_outs', function (Blueprint $table) {
            $table->id();
            $table->string('product'); // Nama barang
            $table->date('expired_date'); // Tanggal kedaluwarsa
            $table->integer('quantity'); // Jumlah barang keluar
            $table->enum('status', ['good', 'expired'])->default('good'); // Status barang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_outs');
    }
};
