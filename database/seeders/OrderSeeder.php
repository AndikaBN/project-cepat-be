<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'kode_order' => 'ORD001',
                'data_otlets_id' => 1,
                'stocks_id' => 1,
                'kode_salesman' => 'SLS001',
                'nama_salesman' => 'Salesman 1',
                'nama_barang' => 'Barang 1',
                'harga_dalam_kota' => '10000',
                'quantity' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_order' => 'ORD002',
                'data_otlets_id' => 2,
                'stocks_id' => 2,
                'kode_salesman' => 'SLS002',
                'nama_salesman' => 'Salesman 2',
                'nama_barang' => 'Barang 2',
                'harga_dalam_kota' => '20000',
                'quantity' => '20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
