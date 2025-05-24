<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pelanggan;

class ProdukController extends Controller
{
    // Menampilkan semua produk
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword) {
            $produk = Produk::where('namaproduk', 'like', "%$keyword%")
                        ->orderBy('namaproduk')
                        ->paginate(10);
        } else {
            $produk = Produk::orderBy('namaproduk')->paginate(10);
        }

        return view('produk.index', compact('produk'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('produk.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'namaproduk' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'stok' => 'required',
            'kategori' => 'nullable|string',
        ]);
        
        $produk = new Produk();
        $produk->namaproduk = $request->namaproduk;
        $produk->harga_jual = $request->harga_jual;
        $produk->harga_beli = $request->harga_beli;
        $produk->stok = $request->stok;
        $produk->kategori = $request->kategori;
        
        $produk->save();
        
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }


    // Menampilkan form edit produk
    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    // Menyimpan perubahan data produk
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $produk->update([
            'namaproduk' => $request->namaproduk,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'stok' => $request->stok,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }


    // Menghapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    // Menampilkan form update stok
    public function showUpdateStokForm($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.update-stok', compact('produk'));
    }

    // Memproses update stok produk
    public function updateStok(Request $request, $id)
    {
        // Validasi input stok
        $request->validate([
            'stok' => 'required|numeric|min:0',
        ]);

        $produk = Produk::findOrFail($id);

        // Update stok produk
        $produk->stok = $request->stok;
        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Stok produk berhasil diperbarui!');
    }
    // Menampilkan detail produk
    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function cetakProduk()
    {
        $produk = Produk::all();
        return view ('produk.cetakProduk', compact('produk'));
    }

}
