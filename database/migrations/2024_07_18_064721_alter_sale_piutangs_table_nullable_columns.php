<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sale_piutangs', function (Blueprint $table) {
            $table->string('tanggal')->nullable()->change();
            $table->string('nomor_nota')->nullable()->change();
            $table->string('kode_customer')->nullable()->change();
            $table->string('nama_customer')->nullable()->change();
            $table->string('daerah')->nullable()->change();
            $table->string('tagihan')->nullable()->change();
            $table->string('antaran')->nullable()->change();
            $table->integer('umur')->nullable()->change();
            $table->string('kode_salesman')->nullable()->change();
            $table->string('nama_salesman')->nullable()->change();
            $table->decimal('total_nota', 15, 2)->nullable()->change();
            $table->decimal('sisa_hutang', 15, 2)->nullable()->change();
            $table->decimal('sisa_hutang_by_sales', 15, 2)->nullable()->change();
            $table->string('persentase_pemberian_barang')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('sale_piutangs', function (Blueprint $table) {
            $table->string('tanggal')->nullable(false)->change();
            $table->string('nomor_nota')->nullable(false)->change();
            $table->string('kode_customer')->nullable(false)->change();
            $table->string('nama_customer')->nullable(false)->change();
            $table->string('daerah')->nullable(false)->change();
            $table->string('tagihan')->nullable(false)->change();
            $table->string('antaran')->nullable(false)->change();
            $table->integer('umur')->nullable(false)->change();
            $table->string('kode_salesman')->nullable(false)->change();
            $table->string('nama_salesman')->nullable(false)->change();
            $table->decimal('total_nota', 15, 2)->nullable(false)->change();
            $table->decimal('sisa_hutang', 15, 2)->nullable(false)->change();
            $table->decimal('sisa_hutang_by_sales', 15, 2)->nullable(false)->change();
            $table->string('persentase_pemberian_barang')->nullable(false)->change();
        });
    }
};
