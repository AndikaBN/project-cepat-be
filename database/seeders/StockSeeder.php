<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stocks')->insert([
            [
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Barang 1',
                'jenis_barang' => 'Jenis 1',
                'divisi' => 'Divisi 1',
                'stock' => '100',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '10000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Barang 2',
                'jenis_barang' => 'Jenis 2',
                'divisi' => 'Divisi 2',
                'stock' => '200',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '20000',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
