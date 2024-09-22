<?php

namespace App\Exports;

use App\Models\Toko;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TokosExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil koleksi data tokos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Toko::all();
    }

    /**
     * Menambahkan header pada file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Toko',
            'Latitude',
            'Longitude',
            'Area',
            'Daerah',
            'created_at',
            'updated_at'
        ];
    }
}
