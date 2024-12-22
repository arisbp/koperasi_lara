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
        Schema::create('transaksi_simpanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('simpanan_id'); // Foreign key ke tabel simpanan
            $table->unsignedBigInteger('user_id');     // Foreign key ke tabel users
            $table->decimal('jumlah', 15, 2);          // Jumlah transaksi
            $table->string('jenis_transaksi');         // setoran/penarikan
            $table->timestamps();
        
            $table->foreign('simpanan_id')->references('id')->on('simpanan')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_simpanan');
    }
};
