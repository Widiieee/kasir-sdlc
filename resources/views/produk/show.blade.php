@extends('layout')

@section('konten')
<div class="container mt-6 mx-auto px-4 max-w-3xl">
    <div class="card shadow-lg p-6 rounded-lg">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-6 text-3xl font-semibold">{{ $produk->namaproduk }}</h3>
                <ul class="list-group list-group-flush mb-6 divide-y divide-gray-200 rounded-md border border-gray-200">
                    <li class="list-group-item px-4 py-3 flex justify-between items-center bg-white">
                        <span class="font-semibold text-gray-700">Kategori:</span>
                        <span class="text-gray-900">{{ $produk->kategori ?? '-' }}</span>
                    </li>
                    <li class="list-group-item px-4 py-3 flex justify-between items-center bg-gray-50">
                        <span class="font-semibold text-gray-700">Harga Beli:</span>
                        <span class="text-gray-900">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item px-4 py-3 flex justify-between items-center bg-white">
                        <span class="font-semibold text-gray-700">Harga Jual:</span>
                        <span class="text-gray-900">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item px-4 py-3 flex justify-between items-center bg-gray-50 rounded-b-md">
                        <span class="font-semibold text-gray-700">Stok:</span>
                        <span class="text-gray-900">{{ $produk->stok }}</span>
                    </li>
                </ul>

                <div class="flex space-x-3 mt-4">
                    <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning inline-flex items-center space-x-2 px-4 py-2 rounded-md shadow hover:brightness-90">
                        <i class="fas fa-edit"></i>
                        <span>Edit</span>
                    </a>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary inline-flex items-center space-x-2 px-4 py-2 rounded-md shadow hover:brightness-90">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
