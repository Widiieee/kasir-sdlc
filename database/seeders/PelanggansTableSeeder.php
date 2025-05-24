<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PelanggansTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pelanggans')->insert([
            [
                'namapelanggan' => 'Budi Santoso',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'nomortelepon' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namapelanggan' => 'Siti Aminah',
                'alamat' => 'Jl. Sudirman No. 25, Bandung',
                'nomortelepon' => '082345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
