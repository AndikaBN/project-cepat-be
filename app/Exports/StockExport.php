<?php

namespace App\Exports;

use App\Models\stock;
use Maatwebsite\Excel\Concerns\FromCollection;

class StockExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return stock::all();
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Jenis Barang',
            'Divisi',
            'Stock',
            'Satuan',
            'Keterangan Isi 1',
            'Keterangan Isi 2',
            'Harga Dalam Kota',
        ];
    }
}
