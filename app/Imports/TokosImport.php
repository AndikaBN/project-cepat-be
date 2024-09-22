<?php

namespace App\Imports;

use App\Models\Toko;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TokosImport implements ToModel
{

    public function model(array $row)
    {
        return new Toko([
            'nama_toko' => $row[0],
            'latitude'  => $row[1],
            'longitude' => $row[2],
            'area'      => $row[3],
            'daerah'      => $row[4],
        ]);
    }
}
