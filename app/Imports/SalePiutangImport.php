<?php

namespace App\Imports;

use App\Models\SalePiutang;
use Maatwebsite\Excel\Concerns\ToModel;

class SalePiutangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)

    {
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])->format('Y-m-d');
        return new SalePiutang([
            'tanggal' => $date,
            'nomor_nota' => $row[1],
            'kode_customer' => $row[2],
            'nama_customer' => $row[3],
            'daerah' => $row[4],
            'tagihan' => $row[5],
            'antaran' => $row[6],
            'umur' => $row[7],
            'kode_salesman' => $row[8],
            'nama_salesman' => $row[9],
            'total_nota' => $row[10],
            'sisa_hutang' => $row[11],
            'sisa_hutang_by_sales' => $row[12],
            'persentase_pemberian_barang' => $row[13],
        ]);
    }
}
