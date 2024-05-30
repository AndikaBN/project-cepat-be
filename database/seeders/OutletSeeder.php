<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('outlets')->insert([
            [
                'user_id' => 1,
                'name' => 'Outlet 1',
                'no_telp' => '08123456789',
                'image_ktp' => 'ktp1.jpg',
                'image_outlet' => 'outlet1.jpg',
                'type' => 'type1',
                'limit' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'name' => 'Outlet 2',
                'no_telp' => '08234567890',
                'image_ktp' => 'ktp2.jpg',
                'image_outlet' => 'outlet2.jpg',
                'type' => 'type2',
                'limit' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

    }
}
