<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = Penjualan::all();
        $produk = Produk::where('stok', '>', 0)->orderBy('namaproduk')->get();
        $pelanggan = Pelanggan::all();  // Mengambil data pelanggan
        return view('transaksi.index', compact('penjualan', 'produk', 'pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_penjualan' => 'required|date',
            'total_harga' => 'required|numeric|min:0',
            'keranjang' => 'required|json',
            'idpelanggan' => 'nullable|exists:pelanggans,id',
            'pelanggan_baru_nama' => 'nullable|string|max:255',
        ]);

        $keranjang = json_decode($request->keranjang, true);

        if (empty($keranjang)) {
            return redirect()->back()->withErrors(['keranjang' => 'Keranjang tidak boleh kosong']);
        }

        // Validasi stok
        foreach ($keranjang as $item) {
            $produk = Produk::find($item['idproduk']);
            if (!$produk) {
                return redirect()->back()->withErrors(['produk' => "Produk dengan ID {$item['idproduk']} tidak ditemukan"]);
            }
            if ($produk->stok < $item['jumlah_produk']) {
                return redirect()->back()->withErrors(['stok' => "Stok produk {$produk->namaproduk} tidak cukup"]);
            }
        }

        DB::beginTransaction();
        try {
            $idPelanggan = $request->idpelanggan;
            if (!$idPelanggan && $request->pelanggan_baru_nama) {
                $pelangganBaru = Pelanggan::create([
                    'namapelanggan' => $request->pelanggan_baru_nama,
                    'alamat' => $request->pelanggan_baru_alamat,
                    'nomortelepon' => $request->pelanggan_baru_nomor,
                ]);
                $idPelanggan = $pelangganBaru->id;
            }

            $penjualan = Penjualan::create([
                'tanggal_penjualan' => $request->tanggal_penjualan,
                'total_harga' => $request->total_harga,
                'idpelanggan' => $idPelanggan,
            ]);

            foreach ($keranjang as $item) {
                $produk = Produk::find($item['idproduk']);
                $subtotal = $produk->harga_jual * $item['jumlah_produk'];

                DetailPenjualan::create([
                    'idpenjualan' => $penjualan->id,
                    'idproduk' => $item['idproduk'],
                    'jumlah_produk' => $item['jumlah_produk'],
                    'subtotal' => $subtotal,
                ]);

                Produk::where('id', $item['idproduk'])->decrement('stok', $item['jumlah_produk']);
            }

            DB::commit();
            return redirect()->back()->with([
                'success' => 'Transaksi berhasil disimpan!',
                'id_penjualan' => $penjualan->id // ganti sesuai variabel yang kamu pakai
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan transaksi: ' . $e->getMessage()]);
        }
    } 


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'detail_penjualan.produk'])->findOrFail($id);
        return view('transaksi.show', compact('penjualan'));
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

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $produk = Produk::where('namaproduk', 'LIKE', "%{$keyword}%")
                    ->where('stok', '>', 0)
                    ->get();

        return response()->json($produk);
    }

    public function cetak($id)
    {
        $penjualan = Penjualan::with('detail_penjualan.produk', 'pelanggan')->findOrFail($id);
        return view('transaksi.cetak', compact('penjualan'));
    }
}
