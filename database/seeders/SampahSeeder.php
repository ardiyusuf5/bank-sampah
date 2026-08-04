<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sampah')->insert([
            [
                'nama_sampah' => 'Botol Plastik',
                'harga_per_kg' => 4000,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sampah' => 'Kertas',
                'harga_per_kg' => 2500,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sampah' => 'Kardus',
                'harga_per_kg' => 3000,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sampah' => 'Kaleng',
                'harga_per_kg' => 7000,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sampah' => 'Besi',
                'harga_per_kg' => 5000,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sampah' => 'Aluminium',
                'harga_per_kg' => 15000,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}