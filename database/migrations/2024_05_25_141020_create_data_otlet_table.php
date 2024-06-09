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
        Schema::create('data_otlets', function (Blueprint $table) {
            $table->id();
            $table->string('stat')->nullable();
            $table->string('bebas_blok')->nullable();
            $table->string('kode')->nullable();
            $table->string('nama_customer')->nullable();
            $table->string('kontak')->nullable();
            $table->string('alamat')->nullable();
            $table->string('daerah')->nullable();
            $table->string('area')->nullable();
            $table->string('telp')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('ktp')->nullable();
            $table->string('npwp')->nullable();
            $table->string('gol')->nullable();
            $table->string('tgl_input')->nullable();
            $table->string('set_harga')->nullable();
            $table->string('area_antaran')->nullable();
            $table->string('area_tagihan')->nullable();
            $table->string('type_customer')->nullable();
            $table->string('limit_kredit')->nullable();
            $table->string('limit_divisi')->nullable();
            $table->string('nama_npwp')->nullable();
            $table->string('alamat_npwp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_otlets');
    }
};
