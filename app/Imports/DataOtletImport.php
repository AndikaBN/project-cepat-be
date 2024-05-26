<?php

namespace App\Imports;

use App\Models\DataOtlet; // Add this import statement

use Maatwebsite\Excel\Concerns\ToModel;

class DataOtletImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new DataOtlet([
            'stat' => $row[0],
            'bebas_blok' => $row[1],
            'kode' => $row[2],
            'nama_customer' => $row[3],
            'kontak' => $row[4],
            'alamat' => $row[5],
            'daerah' => $row[6],
            'area' => $row[7],
            'telp' => $row[8],
            'keterangan' => $row[9],
            'ktp' => $row[10],
            'npwp' => $row[11],
            'gol' => $row[12],
            'tgl_input' => $row[13],
            'set_harga' => $row[14],
            'area_antaran' => $row[15],
            'area_tagihan' => $row[16],
            'type_customer' => $row[17],
            'limit_kredit' => $row[18],
            'limit_divisi' => $row[19],
            'nama_npwp' => $row[20],
            'alamat_npwp' => $row[21]
        ]);
    }
}
