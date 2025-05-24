<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('produks')->insert([
            [
                'nama_produk' => 'Pensil 2B',
                'harga' => 3000,
                'stok' => 100,
            ],
            [
                'nama_produk' => 'Buku Tulis',
                'harga' => 5000,
                'stok' => 200,
            ],
        ]);
    }
}
