<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $fillable = [
        'tanggal_penjualan',
        'total_harga',
        'idpelanggan',
    ];
    public function pelanggan()
    {
        // Foreign key di DB: idpelanggan
        return $this->belongsTo(Pelanggan::class, 'idpelanggan', 'id');
    }

    public function detail_penjualan()
    {
        // Foreign key di detail_penjualans: idpenjualan
        return $this->hasMany(DetailPenjualan::class, 'idpenjualan', 'id');
    }
}
