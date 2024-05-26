<?php

namespace App\Imports;

use App\Models\stock;
use Maatwebsite\Excel\Concerns\ToModel;

class StockImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new stock([
            'kode_barang' => $row[0],
            'nama_barang' => $row[1],
            'jenis_barang' => $row[2],
            'divisi' => $row[3],
            'stock' => $row[4],
            'satuan' => $row[5],
            'keterangan_isi_1' => $row[6],
            'keterangan_isi_2' => $row[7],
            'harga_dalam_kota' => $row[8],
        ]);
    }
}
