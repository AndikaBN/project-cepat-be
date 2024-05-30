<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalePiutangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sale_piutangs')->insert([
            [
                'tanggal' => '2023-05-01',
                'nomor_nota' => 'INV12345',
                'kode_customer' => 'CUST001',
                'nama_customer' => 'John Doe',
                'daerah' => 'Jakarta',
                'tagihan' => 'Tagihan 1',
                'antaran' => 'Antaran 1',
                'umur' => 30,
                'kode_salesman' => 'SLS001',
                'nama_salesman' => 'Salesman 1',
                'total_nota' => 1000000.00,
                'sisa_hutang' => 500000.00,
                'sisa_hutang_by_sales' => 250000.00,
                'persentase_pemberian_barang' => '50%',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => '2023-05-02',
                'nomor_nota' => 'INV12346',
                'kode_customer' => 'CUST002',
                'nama_customer' => 'Jane Smith',
                'daerah' => 'Bandung',
                'tagihan' => 'Tagihan 2',
                'antaran' => 'Antaran 2',
                'umur' => 45,
                'kode_salesman' => 'SLS002',
                'nama_salesman' => 'Salesman 2',
                'total_nota' => 1500000.00,
                'sisa_hutang' => 750000.00,
                'sisa_hutang_by_sales' => 375000.00,
                'persentase_pemberian_barang' => '50%',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
