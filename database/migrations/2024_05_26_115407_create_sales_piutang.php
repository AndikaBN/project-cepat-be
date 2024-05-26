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
            $table->string('tanggal');
            $table->string('nomor_nota');
            $table->string('kode_customer');
            $table->string('nama_customer');
            $table->string('daerah');
            $table->string('tagihan');
            $table->string('antaran');
            $table->integer('umur');
            $table->string('kode_salesman');
            $table->string('nama_salesman');
            $table->decimal('total_nota', 15, 2);
            $table->decimal('sisa_hutang', 15, 2);
            $table->decimal('sisa_hutang_by_sales', 15, 2);
            $table->string('persentase_pemberian_barang');
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
