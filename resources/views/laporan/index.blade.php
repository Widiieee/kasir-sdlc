@extends('layout')

@section('konten')
<div class="container mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-bold mb-4 md:mb-0">Laporan Transaksi</h1>
        <a href="{{ url('cetakLaporan') }}?tanggal={{ request('tanggal') }}&bulan={{ request('bulan') }}&tahun={{ request('tahun') }}" target="_blank" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('laporan.transaksi') }}" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}" />

            <select name="bulan" class="form-control">
                <option value="">-- Pilih Bulan --</option>
                @foreach(range(1, 12) as $month)
                    <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                    </option>
                @endforeach
            </select>

            <select name="tahun" class="form-control">
                <option value="">-- Pilih Tahun --</option>
                @foreach(range(2020, now()->year) as $year)
                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary w-full">Filter</button>
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow p-4 overflow-x-auto">
        <table class="table table-bordered w-full text-sm">
            <thead class="bg-gray-100 text-center">
                <tr>
                    <th class="text-center">#</th>
                    <th>ID Penjualan</th>
                    <th>Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-right">Subtotal</th>
                    <th class="text-center">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($detail_penjualan as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->idpenjualan }}</td>
                        <td>{{ $item->produk->namaproduk ?? 'Produk Tidak Ditemukan' }}</td>
                        <td class="text-center">{{ $item->jumlah_produk }}</td>
                        <td class="text-right">Rp {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                        <td class="text-center">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Tidak ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="card mt-6 p-4 bg-white rounded-lg shadow max-w-md mx-auto">
        <h5 class="font-semibold mb-3 text-lg border-b pb-2">Ringkasan Keuangan</h5>
        <p class="mb-2">
            <strong>Total Pendapatan Kotor:</strong> 
            <span class="text-green-600">Rp {{ number_format($total_kotor, 2, ',', '.') }}</span>
        </p>
        <p>
            <strong>Total Pendapatan Bersih:</strong> 
            <span class="text-blue-600">Rp {{ number_format($total_pendapatan_bersih, 2, ',', '.') }}</span>
        </p>
    </div>

    @if($detail_penjualan->isNotEmpty())
        <div class="text-right mt-6">
            <h5 class="font-semibold text-lg">
                Total Produk Terjual: 
                <span class="text-indigo-600">
                    Rp {{ number_format($detail_penjualan->sum('subtotal'), 2, ',', '.') }}
                </span>
            </h5>
        </div>
    @endif
</div>
@endsection
