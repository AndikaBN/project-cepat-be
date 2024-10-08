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
            [
                'kode_barang' => 'BRG003',
                'nama_barang' => 'Barang 3',
                'jenis_barang' => 'Jenis 3',
                'divisi' => 'Divisi 3',
                'stock' => '300',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '30000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG004',
                'nama_barang' => 'Barang 4',
                'jenis_barang' => 'Jenis 4',
                'divisi' => 'Divisi 4',
                'stock' => '400',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '40000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG005',
                'nama_barang' => 'Barang 5',
                'jenis_barang' => 'Jenis 5',
                'divisi' => 'Divisi 5',
                'stock' => '500',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '50000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG006',
                'nama_barang' => 'Barang 6',
                'jenis_barang' => 'Jenis 6',
                'divisi' => 'Divisi 6',
                'stock' => '600',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '60000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG007',
                'nama_barang' => 'Barang 7',
                'jenis_barang' => 'Jenis 7',
                'divisi' => 'Divisi 7',
                'stock' => '700',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '70000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG008',
                'nama_barang' => 'Barang 8',
                'jenis_barang' => 'Jenis 8',
                'divisi' => 'Divisi 8',
                'stock' => '800',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '80000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG009',
                'nama_barang' => 'Barang 9',
                'jenis_barang' => 'Jenis 9',
                'divisi' => 'Divisi 9',
                'stock' => '900',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '90000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG010',
                'nama_barang' => 'Barang 10',
                'jenis_barang' => 'Jenis 10',
                'divisi' => 'Divisi 10',
                'stock' => '1000',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '100000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG011',
                'nama_barang' => 'Barang 11',
                'jenis_barang' => 'Jenis 11',
                'divisi' => 'Divisi 11',
                'stock' => '1100',
                'satuan' => 'pcs',
                'keterangan_isi_1' => 'Isi 1',
                'keterangan_isi_2' => 'Isi 2',
                'harga_dalam_kota' => '110000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
