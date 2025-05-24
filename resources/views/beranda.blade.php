@extends('layout')

@section('konten')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800">
       @if(auth()->check())
            Selamat Datang, {{ auth()->user()->nama }}
        @else
            Selamat Datang, Pengunjung
        @endif
    </h1>

    <!-- Grid Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <!-- Total Produk -->
        <a href="{{ route('produk.index') }}" class="flex items-center justify-between bg-blue-500 text-white rounded-xl p-5 shadow-md hover:bg-blue-600 transition duration-200">
            <div>
                <p class="text-sm md:text-base">Total Produk</p>
                <p class="text-2xl md:text-3xl font-bold">{{ $totalProduk }}</p>
            </div>
            <i data-feather="box" class="w-8 h-8 md:w-10 md:h-10 opacity-70"></i>
        </a>

        <!-- Total Penjualan Hari Ini -->
        <a href="{{ route('laporan.index') }}" class="flex items-center justify-between bg-green-500 text-white rounded-xl p-5 shadow-md hover:bg-green-600 transition duration-200">
            <div>
                <p class="text-sm md:text-base">Penjualan Hari Ini</p>
                <p class="text-2xl md:text-3xl font-bold">Rp{{ number_format($totalPenjualanHariIni, 0, ',', '.') }}</p>
            </div>
            <i data-feather="shopping-cart" class="w-8 h-8 md:w-10 md:h-10 opacity-70"></i>
        </a>

        <!-- Total Pelanggan -->
        <a href="{{ route('pelanggan.index') }}" class="flex items-center justify-between bg-yellow-500 text-white rounded-xl p-5 shadow-md hover:bg-yellow-600 transition duration-200">
            <div>
                <p class="text-sm md:text-base">Total Pelanggan</p>
                <p class="text-2xl md:text-3xl font-bold">{{ $totalPelanggan }}</p>
            </div>
            <i data-feather="users" class="w-8 h-8 md:w-10 md:h-10 opacity-70"></i>
        </a>
    </div>

    <!-- Daftar Produk dengan Stok Rendah -->
    <div class="bg-white shadow-md rounded-xl p-6">
        <h2 class="text-lg font-semibold text-red-600 mb-4 flex items-center gap-2">
            <i data-feather="alert-circle" class="w-5 h-5 text-red-500"></i>
            Produk dengan Stok Rendah (&lt; 10)
        </h2>
        @if ($produkStokRendah->isEmpty())
            <p class="text-sm text-gray-600">Semua stok produk mencukupi.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-sm">
                    <thead class="bg-gray-100 text-left text-gray-600 uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-2">Nama Produk</th>
                            <th class="px-4 py-2 text-center">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produkStokRendah as $produk)
                        <tr class="border-t hover:bg-red-50 cursor-pointer" onclick="window.location='{{ route('produk.edit', $produk->id) }}'">
                            <td class="px-4 py-2 text-gray-800">{{ $produk->namaproduk }}</td>
                            <td class="px-4 py-2 text-center text-red-500 font-semibold">{{ $produk->stok }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
