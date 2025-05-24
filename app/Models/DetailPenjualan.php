<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'idpenjualan',
        'idproduk',
        'jumlah_produk',
        'subtotal',
    ];
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idproduk');
    }

    public function penjualan()
    {
        // Foreign key di detail_penjualans: idpenjualan
        return $this->belongsTo(Penjualan::class, 'idpenjualan', 'id');
    }
}
