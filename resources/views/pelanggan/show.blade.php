@extends('layout')

@section('konten')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Detail Pelanggan</h2>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    {{-- Detail Pribadi --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-8">
        <h3 class="text-xl font-semibold mb-4">Informasi Pribadi</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-gray-700">
            <div>
                <p class="font-semibold">Nama Pelanggan:</p>
                <p>{{ $pelanggan->namapelanggan }}</p>
            </div>
            <div>
                <p class="font-semibold">Alamat:</p>
                <p>{{ $pelanggan->alamat }}</p>
            </div>
            <div>
                <p class="font-semibold">No Telepon:</p>
                <p>{{ $pelanggan->nomortelepon }}</p>
            </div>
        </div>
    </div>

    {{-- Riwayat Transaksi --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-xl font-semibold mb-4">Riwayat Transaksi</h3>

        @if($pelanggan->penjualans->isEmpty())
            <p class="text-gray-600">Belum ada transaksi.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table table-bordered w-full text-sm">
                    <thead class="bg-gray-100 text-center">
                        <tr>
                            <th class="py-2 px-3">Tanggal</th>
                            <th class="py-2 px-3">Total Harga</th>
                            <th class="py-2 px-3">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan->penjualans as $penjualan)
                        <tr class="text-center">
                            <td class="py-2 px-3">{{ $penjualan->created_at->format('d-m-Y') }}</td>
                            <td class="py-2 px-3">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                            <td class="py-2 px-3">
                                <a href="{{ route('transaksi.show', $penjualan->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
