<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tagihans')->insert([
            [
                'user_id' => 1,
                'nama_outlet' => 'Outlet 1',
                'nomor_nota' => '123456789',
                'jumlah_tagihan' => 100000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nama_outlet' => 'Outlet 2',
                'nomor_nota' => '987654321',
                'jumlah_tagihan' => 200000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'nama_outlet' => 'Outlet 3',
                'nomor_nota' => '123456789',
                'jumlah_tagihan' => 300000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'nama_outlet' => 'Outlet 4',
                'nomor_nota' => '987654321',
                'jumlah_tagihan' => 400000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'nama_outlet' => 'Outlet 5',
                'nomor_nota' => '123456789',
                'jumlah_tagihan' => 500000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'nama_outlet' => 'Outlet 6',
                'nomor_nota' => '987654321',
                'jumlah_tagihan' => 600000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'nama_outlet' => 'Outlet 7',
                'nomor_nota' => '123456789',
                'jumlah_tagihan' => 700000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'nama_outlet' => 'Outlet 8',
                'nomor_nota' => '987654321',
                'jumlah_tagihan' => 800000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'nama_outlet' => 'Outlet 9',
                'nomor_nota' => '123456789',
                'jumlah_tagihan' => 900000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'nama_outlet' => 'Outlet 10',
                'nomor_nota' => '987654321',
                'jumlah_tagihan' => 1000000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama_outlet' => 'Outlet 11',
                'nomor_nota' => '123456789',
                'jumlah_tagihan' => 1100000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
