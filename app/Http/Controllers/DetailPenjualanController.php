<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;

class DetailPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail_penjualan = DetailPenjualan::with('produk')->get();
        $penjualans = Penjualan::with('pelanggan')->get();

        $total_kotor = $detail_penjualan->sum('subtotal');

        $total_pendapatan_bersih = $detail_penjualan->sum(function ($item) {
            $harga_jual = $item->produk->harga_jual ?? 0;
            $harga_beli = $item->produk->harga_beli ?? 0;
            return ($item->jumlah_produk * $harga_jual) - ($item->jumlah_produk * $harga_beli);
        });

        return view('laporan.index', compact(
            'detail_penjualan', 
            'penjualans',
            'total_kotor', 
            'total_pendapatan_bersih'
        ));
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

    public function laporan(Request $request)
    {
        // Ambil data detail penjualan dengan relasi produk dan penjualan->pelanggan
        $query = DetailPenjualan::with(['penjualan.pelanggan', 'produk']);

        if ($request->has('tanggal') && $request->tanggal) {
            $query->whereHas('penjualan', function ($q) use ($request) {
            $q->whereDate('tanggal_penjualan', $request->tanggal);
        });
        }

        if ($request->has('bulan') && $request->bulan) {
            $query->whereHas('penjualan', function ($q) use ($request) {
                $q->whereMonth('tanggal_penjualan', $request->bulan);
            });
        }

        if ($request->has('tahun') && $request->tahun) {
            $query->whereHas('penjualan', function ($q) use ($request) {
                $q->whereYear('tanggal_penjualan', $request->tahun);
            });
        }

        $detail_penjualan = $query->get();

        // Perhitungan total kotor dan total pendapatan bersih
        $total_kotor = $detail_penjualan->sum('subtotal');

        $total_pendapatan_bersih = $detail_penjualan->sum(function ($item) {
            $harga_jual = $item->produk->harga_jual ?? 0;
            $harga_beli = $item->produk->harga_beli ?? 0;
            return ($item->jumlah_produk * $harga_jual) - ($item->jumlah_produk * $harga_beli);
        });

        // Ambil data penjualan (bisa juga filter sesuai kebutuhan)
        $penjualans = Penjualan::with('pelanggan')->get();

        // Kirim data ke view
        return view('laporan.index', compact(
            'detail_penjualan', 
            'penjualans',
            'total_kotor',
            'total_pendapatan_bersih'
        ));
    }
    public function cetakLaporan(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = DetailPenjualan::with('produk');

        if ($tanggal) {
            $query->whereDate('created_at', $tanggal);
        } elseif ($bulan && $tahun) {
            $query->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan);
        } elseif ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $detail_penjualan = $query->orderBy('created_at', 'desc')->get();

        $total_kotor = $detail_penjualan->sum('subtotal');
        $total_pendapatan_bersih = $total_kotor; // Sesuaikan jika ada perhitungan lain

        return view('laporan.cetakLaporan', compact('detail_penjualan', 'total_kotor', 'total_pendapatan_bersih'));
    }

}
