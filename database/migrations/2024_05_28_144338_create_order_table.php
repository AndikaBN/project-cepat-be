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
        Schema::create('data_order', function (Blueprint $table) {
            $table->id();
            $table->string('kode_order');
            $table->foreignId('outlets_id')->constrained('outlets');
            $table->foreignId('stocks_id')->constrained('stocks');
            $table->string('kode_salesman');
            $table->string('nama_salesman');
            $table->string('nama_barang');
            $table->string('harga_dalam_kota');
            $table->string('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_order');
    }
};
