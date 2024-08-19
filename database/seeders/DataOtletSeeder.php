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
                'kode' => 'OUT003',
                'nama_customer' => 'Customer 3',
                'kontak' => 'John Smith',
                'alamat' => 'Jl. Gatot Subroto No.3',
                'daerah' => 'Surabaya',
                'area' => 'Area 3',
                'telp' => '08345678901',
                'keterangan' => 'Keterangan 3',
                'ktp' => '3456789012',
                'npwp' => '2987654321',
                'gol' => 'Golongan 3',
                'tgl_input' => '2023-05-03',
                'set_harga' => 'Harga 3',
                'area_antaran' => 'Antaran 3',
                'area_tagihan' => 'Tagihan 3',
                'type_customer' => 'Retail',
                'limit_kredit' => '7000000',
                'limit_divisi' => 'Divisi 3',
                'nama_npwp' => 'John Smith',
                'alamat_npwp' => 'Jl. Gatot Subroto No.3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat' => 'Inactive',
                'bebas_blok' => 'No',
                'kode' => 'OUT004',
                'nama_customer' => 'Customer 4',
                'kontak' => 'Jane Doe',
                'alamat' => 'Jl. Thamrin No.4',
                'daerah' => 'Medan',
                'area' => 'Area 4',
                'telp' => '08456789012',
                'keterangan' => 'Keterangan 4',
                'ktp' => '4567890123',
                'npwp' => '3987654321',
                'gol' => 'Golongan 4',
                'tgl_input' => '2023-05-04',
                'set_harga' => 'Harga 4',
                'area_antaran' => 'Antaran 4',
                'area_tagihan' => 'Tagihan 4',
                'type_customer' => 'Wholesale',
                'limit_kredit' => '12000000',
                'limit_divisi' => 'Divisi 4',
                'nama_npwp' => 'Jane Doe',
                'alamat_npwp' => 'Jl. Thamrin No.4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat' => 'Active',
                'bebas_blok' => 'Yes',
                'kode' => 'OUT005',
                'nama_customer' => 'Customer 5',
                'kontak' => 'John Johnson',
                'alamat' => 'Jl. Asia Afrika No.5',
                'daerah' => 'Yogyakarta',
                'area' => 'Area 5',
                'telp' => '08567890123',
                'keterangan' => 'Keterangan 5',
                'ktp' => '5678901234',
                'npwp' => '4987654321',
                'gol' => 'Golongan 5',
                'tgl_input' => '2023-05-05',
                'set_harga' => 'Harga 5',
                'area_antaran' => 'Antaran 5',
                'area_tagihan' => 'Tagihan 5',
                'type_customer' => 'Retail',
                'limit_kredit' => '9000000',
                'limit_divisi' => 'Divisi 5',
                'nama_npwp' => 'John Johnson',
                'alamat_npwp' => 'Jl. Asia Afrika No.5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat' => 'Inactive',
                'bebas_blok' => 'No',
                'kode' => 'OUT006',
                'nama_customer' => 'Customer 6',
                'kontak' => 'Jane Johnson',
                'alamat' => 'Jl. Diponegoro No.6',
                'daerah' => 'Semarang',
                'area' => 'Area 6',
                'telp' => '08678901234',
                'keterangan' => 'Keterangan 6',
                'ktp' => '6789012345',
                'npwp' => '5987654321',
                'gol' => 'Golongan 6',
                'tgl_input' => '2023-05-06',
                'set_harga' => 'Harga 6',
                'area_antaran' => 'Antaran 6',
                'area_tagihan' => 'Tagihan 6',
                'type_customer' => 'Wholesale',
                'limit_kredit' => '15000000',
                'limit_divisi' => 'Divisi 6',
                'nama_npwp' => 'Jane Johnson',
                'alamat_npwp' => 'Jl. Diponegoro No.6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat' => 'Active',
                'bebas_blok' => 'Yes',
                'kode' => 'OUT007',
                'nama_customer' => 'Customer 7',
                'kontak' => 'John Williams',
                'alamat' => 'Jl. Pahlawan No.7',
                'daerah' => 'Surabaya',
                'area' => 'Area 7',
                'telp' => '08789012345',
                'keterangan' => 'Keterangan 7',
                'ktp' => '7890123456',
                'npwp' => '6987654321',
                'gol' => 'Golongan 7',
                'tgl_input' => '2023-05-07',
                'set_harga' => 'Harga 7',
                'area_antaran' => 'Antaran 7',
                'area_tagihan' => 'Tagihan 7',
                'type_customer' => 'Retail',
                'limit_kredit' => '11000000',
                'limit_divisi' => 'Divisi 7',
                'nama_npwp' => 'John Williams',
                'alamat_npwp' => 'Jl. Pahlawan No.7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat' => 'Inactive',
                'bebas_blok' => 'No',
                'kode' => 'OUT008',
                'nama_customer' => 'Customer 8',
                'kontak' => 'Jane Williams',
                'alamat' => 'Jl. Veteran No.8',
                'daerah' => 'Bandung',
                'area' => 'Area 8',
                'telp' => '08890123456',
                'keterangan' => 'Keterangan 8',
                'ktp' => '8901234567',
                'npwp' => '7987654321',
                'gol' => 'Golongan 8',
                'tgl_input' => '2023-05-08',
                'set_harga' => 'Harga 8',
                'area_antaran' => 'Antaran 8',
                'area_tagihan' => 'Tagihan 8',
                'type_customer' => 'Wholesale',
                'limit_kredit' => '18000000',
                'limit_divisi' => 'Divisi 8',
                'nama_npwp' => 'Jane Williams',
                'alamat_npwp' => 'Jl. Veteran No.8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat' => 'Active',
                'bebas_blok' => 'Yes',
                'kode' => 'OUT009',
                'nama_customer' => 'Customer 9',
                'kontak' => 'John Brown',
                'alamat' => 'Jl. A. Yani No.9',
                'daerah' => 'Yogyakarta',
                'area' => 'Area 9',
                'telp' => '08901234567',
                'keterangan' => 'Keterangan 9',
                'ktp' => '9012345678',
                'npwp' => '8987654321',
                'gol' => 'Golongan 9',
                'tgl_input' => '2023-05-09',
                'set_harga' => 'Harga 9',
                'area_antaran' => 'Antaran 9',
                'area_tagihan' => 'Tagihan 9',
                'type_customer' => 'Retail',
                'limit_kredit' => '13000000',
                'limit_divisi' => 'Divisi 9',
                'nama_npwp' => 'John Brown',
                'alamat_npwp' => 'Jl. A. Yani No.9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat' => 'Inactive',
                'bebas_blok' => 'No',
                'kode' => 'OUT010',
                'nama_customer' => 'Customer 10',
                'kontak' => 'Jane Brown',
                'alamat' => 'Jl. Gajah Mada No.10',
                'daerah' => 'Semarang',
                'area' => 'Area 10',
                'telp' => '09012345678',
                'keterangan' => 'Keterangan 10',
                'ktp' => '0123456789',
                'npwp' => '9987654321',
                'gol' => 'Golongan 10',
                'tgl_input' => '2023-05-10',
                'set_harga' => 'Harga 10',
                'area_antaran' => 'Antaran 10',
                'area_tagihan' => 'Tagihan 10',
                'type_customer' => 'Wholesale',
                'limit_kredit' => '20000000',
                'limit_divisi' => 'Divisi 10',
                'nama_npwp' => 'Jane Brown',
                'alamat_npwp' => 'Jl. Gajah Mada No.10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat' => 'Active',
                'bebas_blok' => 'Yes',
                'kode' => 'OUT011',
                'nama_customer' => 'Customer 11',
                'kontak' => 'John Davis',
                'alamat' => 'Jl. Diponegoro No.11',
                'daerah' => 'Surabaya',
                'area' => 'Area 11',
                'telp' => '09123456789',
                'keterangan' => 'Keterangan 11',
                'ktp' => '1234567890',
                'npwp' => '0987654321',
                'gol' => 'Golongan 11',
                'tgl_input' => '2023-05-11',
                'set_harga' => 'Harga 11',
                'area_antaran' => 'Antaran 11',
                'area_tagihan' => 'Tagihan 11',
                'type_customer' => 'Retail',
                'limit_kredit' => '16000000',
                'limit_divisi' => 'Divisi 11',
                'nama_npwp' => 'John Davis',
                'alamat_npwp' => 'Jl. Diponegoro No.11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
