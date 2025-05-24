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
                'namaproduk'   => 'Pulpen Hitam',
                'harga_jual'   => 3500,
                'harga_beli'   => 2000,
                'kategori'     => 'Alat Tulis',
                'stok'         => 150,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'namaproduk'   => 'Penghapus Kecil',
                'harga_jual'   => 1000,
                'harga_beli'   => 500,
                'kategori'     => 'Alat Tulis',
                'stok'         => 300,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'namaproduk'   => 'Buku Gambar A4',
                'harga_jual'   => 7000,
                'harga_beli'   => 5000,
                'kategori'     => 'Kertas',
                'stok'         => 80,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
