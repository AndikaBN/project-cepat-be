<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /*
    $table->foreignId('sale_piutang_id')->constrained('sale_piutangs');
            $table->foreignId('stocks_id')->constrained('stocks');
            $table->string('kode_salesman');
            $table->string('nama_salesman');
            $table->string('nama_barang');
            $table->string('harga_dalam_kota');
    */

    protected $fillable = [

        /*
            $table->string('kode_order');
            $table->foreignId('outlets_id')->constrained('outlets');
            $table->foreignId('stocks_id')->constrained('stocks');
            $table->string('kode_salesman');
            $table->string('nama_salesman');
            $table->string('nama_barang');
            $table->string('harga_dalam_kota');
            $table->string('quantity');
        */

        'kode_order',
        'outlets_id',
        'stocks_id',
        'kode_salesman',
        'nama_salesman',
        'nama_barang',
        'harga_dalam_kota',
        'quantity'
    ];
}
