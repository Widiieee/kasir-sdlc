@extends('layout')

@section('konten')
<div class="container mt-8 mx-auto max-w-4xl p-6 bg-white rounded-lg shadow-md">
    <h4 class="text-2xl font-semibold mb-6 text-center text-gray-800">Detail Transaksi</h4>

    <div class="mb-6 text-gray-700 space-y-1 text-sm md:text-base">
        <p><span class="font-semibold">Tanggal:</span> {{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d-m-Y') }}</p>
        <p><span class="font-semibold">Pelanggan:</span> {{ $penjualan->pelanggan->namapelanggan ?? 'Umum' }}</p>
        <p><span class="font-semibold">Total Transaksi:</span> 
            <span class="text-green-600 font-semibold">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</span>
        </p>
    </div>

    <div class="overflow-x-auto">
        <table class="table table-bordered w-full text-center border border-gray-200">
            <thead class="thead-light bg-gray-100 text-gray-700 uppercase text-sm md:text-base">
                <tr>
                    <th class="py-3 px-4 border border-gray-300">Nama Produk</th>
                    <th class="py-3 px-4 border border-gray-300">Jumlah</th>
                    <th class="py-3 px-4 border border-gray-300">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @if ($penjualan->detail_penjualan->isEmpty())
                    <tr>
                        <td colspan="3" class="py-4 text-gray-500 italic">Detail penjualan belum tersedia.</td>
                    </tr>
                @else
                    @foreach ($penjualan->detail_penjualan as $detail)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border border-gray-300">
                                {{ $detail->produk->namaproduk ?? 'Produk tidak ditemukan' }}
                            </td>
                            <td class="py-3 px-4 border border-gray-300">{{ $detail->jumlah_produk }}</td>
                            <td class="py-3 px-4 border border-gray-300 text-green-600 font-medium">
                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-start">
        <a href="{{ url()->previous() }}" 
           class="btn btn-secondary inline-flex items-center gap-2 px-4 py-2 rounded-md 
                  bg-gray-600 text-white hover:bg-gray-700 transition duration-200">
            ← Kembali
        </a>
    </div>
</div>
@endsection
