<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')->constrained('pinjaman')->onDelete('cascade');
            $table->decimal('jumlah_pembayaran', 8, 2); // Jumlah pembayaran
            $table->decimal('denda', 8, 2)->default(0); // Denda pada saat pembayaran
            $table->date('tanggal_pembayaran'); // Tanggal pembayaran
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
