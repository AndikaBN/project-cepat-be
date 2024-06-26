<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    /*
     $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->string('divisi');
            $table->string('stock');
            $table->string('satuan');
            $table->string('keterangan_isi_1');
            $table->string('keterangan_isi_2');
            $table->string('harga_dalam_kota');
            $table->timestamps();
    */

    protected $fillable = [
        'id',
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'divisi',
        'stock',
        'satuan',
        'keterangan_isi_1',
        'keterangan_isi_2',
        'harga_dalam_kota',
    ];

    public $timestamps = false;
}
