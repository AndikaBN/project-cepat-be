<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_order',
        'data_otlets_id',
        'stocks_id',
        'kode_salesman',
        'nama_salesman',
        'nama_barang',
        'harga_dalam_kota',
        'quantity',
        'status'
    ];

    public function stock()
    {
        return $this->belongsTo(stock::class, 'stocks_id');
    }

    public function outlet()
    {
        return $this->belongsTo(DataOtlet::class, 'data_otlets_id', 'id');
    }
}
