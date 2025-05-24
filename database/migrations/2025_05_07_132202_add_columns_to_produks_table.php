<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            if (!Schema::hasColumn('produks', 'harga_jual')) {
                $table->integer('harga_jual')->after('namaproduk');
            }

            // Cek kolom lain juga jika ada
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'harga_jual')) {
                $table->dropColumn('harga_jual');
            }

            // Kolom lain juga
        });
    }

};
