<?php

namespace App\Exports;

use App\Models\DataOtlet;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataOtletExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataOtlet::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Stat',
            'Bebas Blok',
            'Kode',
            'Nama Customer',
            'Kontak',
            'Alamat',
            'Daerah',
            'Area',
            'Telp',
            'Keterangan',
            'KTP',
            'NPWP',
            'Gol',
            'Tgl Input',
            'Set Harga',
            'Area Antaran',
            'Area Tagihan',
            'Type Customer',
            'Limit Kredit',
            'Limit Divisi',
            'Nama NPWP',
            'Alamat NPWP',
        ];
    }
}
