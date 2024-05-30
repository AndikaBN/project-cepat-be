<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataOtletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_otlets')->insert([
            [
                'stat' => 'Active',
                'bebas_blok' => 'Yes',
                'kode' => 'OUT001',
                'nama_customer' => 'Customer 1',
                'kontak' => 'John Doe',
                'alamat' => 'Jl. Merdeka No.1',
                'daerah' => 'Jakarta',
                'area' => 'Area 1',
                'telp' => '08123456789',
                'keterangan' => 'Keterangan 1',
                'ktp' => '1234567890',
                'npwp' => '0987654321',
                'gol' => 'Golongan 1',
                'tgl_input' => '2023-05-01',
                'set_harga' => 'Harga 1',
                'area_antaran' => 'Antaran 1',
                'area_tagihan' => 'Tagihan 1',
                'type_customer' => 'Retail',
                'limit_kredit' => '5000000',
                'limit_divisi' => 'Divisi 1',
                'nama_npwp' => 'John Doe',
                'alamat_npwp' => 'Jl. Merdeka No.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat' => 'Inactive',
                'bebas_blok' => 'No',
                'kode' => 'OUT002',
                'nama_customer' => 'Customer 2',
                'kontak' => 'Jane Smith',
                'alamat' => 'Jl. Sudirman No.2',
                'daerah' => 'Bandung',
                'area' => 'Area 2',
                'telp' => '08234567890',
                'keterangan' => 'Keterangan 2',
                'ktp' => '2345678901',
                'npwp' => '1987654321',
                'gol' => 'Golongan 2',
                'tgl_input' => '2023-05-02',
                'set_harga' => 'Harga 2',
                'area_antaran' => 'Antaran 2',
                'area_tagihan' => 'Tagihan 2',
                'type_customer' => 'Wholesale',
                'limit_kredit' => '10000000',
                'limit_divisi' => 'Divisi 2',
                'nama_npwp' => 'Jane Smith',
                'alamat_npwp' => 'Jl. Sudirman No.2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
