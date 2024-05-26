<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePiutang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'tanggal',
        'nomor_nota',
        'kode_customer',
        'nama_customer',
        'daerah',
        'tagihan',
        'antaran',
        'umur',
        'kode_salesman',
        'nama_salesman',
        'total_nota',
        'sisa_hutang',
        'sisa_hutang_by_sales',
        'persentase_pemberian_barang',
    ];

    public $timestamps = false;
}
