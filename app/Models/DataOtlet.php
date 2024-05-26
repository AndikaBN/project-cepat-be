<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOtlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'stat',
        'bebas_blok',
        'kode',
        'nama_customer',
        'kontak',
        'alamat',
        'daerah',
        'area',
        'telp',
        'keterangan',
        'ktp',
        'npwp',
        'gol',
        'tgl_input',
        'set_harga',
        'area_antaran',
        'area_tagihan',
        'type_customer',
        'limit_kredit',
        'limit_divisi',
        'nama_npwp',
        'alamat_npwp',
    ];
}
