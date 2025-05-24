<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProduksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('produks')->insert([
            [
                'namaproduk' => 'Kaos Polos',
                'harga_jual' => 50000,
                'harga_beli' => 30000,
                'kategori' => 'Pakaian',
                'stok' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaproduk' => 'Celana Jeans',
                'harga_jual' => 120000,
                'harga_beli' => 80000,
                'kategori' => 'Pakaian',
                'stok' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaproduk' => 'Topi Baseball',
                'harga_jual' => 75000,
                'harga_beli' => 40000,
                'kategori' => 'Aksesoris',
                'stok' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
