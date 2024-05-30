<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(4)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test Andika Owner',
            'email' => 'iniakun@owner.com',
            'password' => Hash::make('12345678'),
            'role' => 'owner',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Andika Sales',
            'email' => 'iniakun@sales.com',
            'password' => Hash::make('12345678'),
            'role' => 'sales',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Andika Kolektor',
            'email' => 'iniakun@kolektor.com',
            'password' => Hash::make('12345678'),
            'role' => 'kolektor',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Andika Inputer',
            'email' => 'iniakun@inputer.com',
            'password' => Hash::make('12345678'),
            'role' => 'inputer',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Andika Gudang',
            'email' => 'iniakun@gudang.com',
            'password' => Hash::make('12345678'),
            'role' => 'gudang',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Andika Marketing',
            'email' => 'iniakun@marketing.com',
            'password' => Hash::make('12345678'),
            'role' => 'marketing',
        ]);

        $this->call([
            OutletSeeder::class,
            SalePiutangSeeder::class,
            StockSeeder::class,
            DataOtletSeeder::class,
            OrderSeeder::class,
        ]);


    }
}
