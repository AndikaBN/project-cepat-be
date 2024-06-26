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
        //change order to orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('kode_order');
            $table->foreignId('data_otlets_id')->constrained('data_otlets');
            $table->foreignId('stocks_id')->constrained('stocks');
            $table->string('kode_salesman');
            $table->string('nama_salesman');
            $table->string('nama_barang');
            $table->string('harga_dalam_kota');
            $table->string('quantity');
            $table->enum('status', [
                'pending',
                'canceled',
                'completed',
            ])->default('pending');
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
