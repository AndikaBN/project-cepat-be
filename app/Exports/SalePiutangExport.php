<?php

namespace App\Exports;

use App\Models\SalePiutang;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalePiutangExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SalePiutang::all();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nomor Nota',
            'Kode Customer',
            'Nama Customer',
            'Daerah',
            'Tagihan',
            'Antaran',
            'Umur',
            'Kode Salesman',
            'Nama Salesman',
            'Total Nota',
            'Sisa Hutang',
            'Sisa Hutang By Sales',
            'Persentase Pemberian Barang',
        ];
    }
}
