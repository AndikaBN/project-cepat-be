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

        ]);
    }
}
