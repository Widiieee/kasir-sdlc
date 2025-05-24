<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\DetailPenjualan;
use Carbon\Carbon;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hitung total produk
        $totalProduk = Produk::count();

         // Total pelanggan
        $totalPelanggan = Pelanggan::count();

        // Tanggal hari ini (format Y-m-d)
        $today = Carbon::today()->toDateString();

        // Total penjualan hari ini berdasarkan detail_penjualan dan relasi penjualan dengan filter tanggal_penjualan
        $totalPenjualanHariIni = DetailPenjualan::whereHas('penjualan', function ($query) use ($today) {
            $query->whereDate('tanggal_penjualan', $today);
        })->sum('subtotal');

        // Produk stok rendah
        $produkStokRendah = Produk::where('stok', '<', 10)->orderBy('stok')->get();

        return view('beranda', compact('totalProduk', 'totalPenjualanHariIni', 'totalPelanggan', 'produkStokRendah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
