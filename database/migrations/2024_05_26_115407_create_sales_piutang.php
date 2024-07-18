<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale_piutangs', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal')->nullable();
            $table->string('nomor_nota')->nullable();
            $table->string('kode_customer')->nullable();
            $table->string('nama_customer')->nullable();
            $table->string('daerah')->nullable();
            $table->string('tagihan')->nullable();
            $table->string('antaran')->nullable();
            $table->integer('umur')->nullable();
            $table->string('kode_salesman')->nullable();
            $table->string('nama_salesman')->nullable();
            $table->decimal('total_nota', 15, 2)->nullable();
            $table->decimal('sisa_hutang', 15, 2)->nullable();
            $table->decimal('sisa_hutang_by_sales', 15, 2)->nullable();
            $table->string('persentase_pemberian_barang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_piutangs');
    }
};
