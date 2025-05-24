@extends('layout')

@section('konten')
<div class="container mt-6 mx-auto px-4">
    <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data" class="max-w-4xl mx-auto">
        @csrf
        <div class="card shadow-lg p-6 rounded-lg">
            <h3 class="text-center text-2xl font-semibold mb-6">Tambah Produk</h3>
            <div class="row">
                <!-- Kolom kiri -->
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="namaproduk" class="form-label font-medium">Nama Produk</label>
                        <input type="text" name="namaproduk" id="namaproduk" class="form-control rounded-md border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-transparent" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="kategori" class="form-label font-medium">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control rounded-md border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    </div>
                </div>

                <!-- Kolom kanan -->
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="harga_jual" class="form-label font-medium">Harga Jual</label>
                        <input type="number" name="harga_jual" id="harga_jual" class="form-control rounded-md border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-transparent" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="harga_beli" class="form-label font-medium">Harga Beli</label>
                        <input type="number" name="harga_beli" id="harga_beli" class="form-control rounded-md border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-transparent" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="stok" class="form-label font-medium">Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control rounded-md border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-transparent" required>
                    </div>
                </div>
            </div>

            <div class="text-center mt-6 space-x-3">
                <button type="submit" class="btn btn-success px-6 py-2 rounded-md inline-flex items-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Simpan</span>
                </button>

                <a href="{{ route('produk.index') }}" class="btn btn-secondary px-6 py-2 rounded-md inline-flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-5 rounded-lg shadow-sm max-w-4xl mx-auto">
            <ul class="mb-0 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
