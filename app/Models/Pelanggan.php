<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namapelanggan',
        'alamat',
        'nomortelepon',
    ];
    public $timestamps = true;

    // Pelanggan.php (Model)
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'idpelanggan', 'id');
    }

}
