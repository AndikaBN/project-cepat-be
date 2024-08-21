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
            [
                'user_id' => 3,
                'name' => 'Outlet 3',
                'no_telp' => '08345678901',
                'image_ktp' => 'ktp3.jpg',
                'image_outlet' => 'outlet3.jpg',
                'type' => 'type3',
                'limit' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'name' => 'Outlet 4',
                'no_telp' => '08456789012',
                'image_ktp' => 'ktp4.jpg',
                'image_outlet' => 'outlet4.jpg',
                'type' => 'type4',
                'limit' => 400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'name' => 'Outlet 5',
                'no_telp' => '08567890123',
                'image_ktp' => 'ktp5.jpg',
                'image_outlet' => 'outlet5.jpg',
                'type' => 'type5',
                'limit' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'name' => 'Outlet 6',
                'no_telp' => '08678901234',
                'image_ktp' => 'ktp6.jpg',
                'image_outlet' => 'outlet6.jpg',
                'type' => 'type6',
                'limit' => 600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'name' => 'Outlet 7',
                'no_telp' => '08789012345',
                'image_ktp' => 'ktp7.jpg',
                'image_outlet' => 'outlet7.jpg',
                'type' => 'type7',
                'limit' => 700,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'name' => 'Outlet 8',
                'no_telp' => '08890123456',
                'image_ktp' => 'ktp8.jpg',
                'image_outlet' => 'outlet8.jpg',
                'type' => 'type8',
                'limit' => 800,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'name' => 'Outlet 9',
                'no_telp' => '08901234567',
                'image_ktp' => 'ktp9.jpg',
                'image_outlet' => 'outlet9.jpg',
                'type' => 'type9',
                'limit' => 900,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'name' => 'Outlet 10',
                'no_telp' => '09012345678',
                'image_ktp' => 'ktp10.jpg',
                'image_outlet' => 'outlet10.jpg',
                'type' => 'type10',
                'limit' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 11,
                'name' => 'Outlet 11',
                'no_telp' => '09123456789',
                'image_ktp' => 'ktp11.jpg',
                'image_outlet' => 'outlet11.jpg',
                'type' => 'type11',
                'limit' => 1100,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

    }
}
