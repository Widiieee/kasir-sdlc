@extends('layout')

@section('konten')
<div class="container mt-8 mx-auto px-4 max-w-3xl">
    <form method="POST" action="{{ route('produk.update', $produk->id) }}">
        @csrf
        @method('PUT')
        <div class="card shadow-lg p-6 rounded-lg">
            <h3 class="mb-6 text-center text-2xl font-semibold">Edit Produk</h3>
            <div class="row">
                <!-- Kolom kiri -->
                <div class="col-md-6">
                    <div class="form-group mb-5">
                        <label for="namaproduk" class="form-label font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="namaproduk" class="form-control rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               value="{{ $produk->namaproduk }}" required>
                    </div>

                    <div class="form-group mb-5">
                        <label for="kategori" class="form-label font-medium text-gray-700">Kategori</label>
                        <input type="text" name="kategori" class="form-control rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               value="{{ $produk->kategori }}">
                    </div>
                </div>

                <!-- Kolom kanan -->
                <div class="col-md-6">
                    <div class="form-group mb-5">
                        <label for="harga_jual" class="form-label font-medium text-gray-700">Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ $produk->harga_jual }}" required placeholder="Contoh: 100000">
                    </div>

                    <div class="form-group mb-5">
                        <label for="harga_beli" class="form-label font-medium text-gray-700">Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ $produk->harga_beli }}" required placeholder="Contoh: 80000">
                    </div>

                    <div class="form-group mb-5">
                        <label for="stok" class="form-label font-medium text-gray-700">Stok</label>
                        <input type="number" name="stok" class="form-control rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ $produk->stok }}" required>
                    </div>
                </div>
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="btn btn-success px-6 py-2 rounded-md inline-flex items-center space-x-2 hover:brightness-90">
                    <i class="fas fa-save"></i>
                    <span>Simpan Perubahan</span>
                </button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary px-6 py-2 rounded-md inline-flex items-center space-x-2 hover:brightness-90 ms-3">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
