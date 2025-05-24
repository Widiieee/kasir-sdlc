<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Cetak Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Laporan Transaksi</h2>

        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th>#</th>
                    <th>ID Penjualan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($detail_penjualan as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->idpenjualan }}</td>
                        <td>{{ $item->produk->namaproduk ?? 'Produk Tidak Ditemukan' }}</td>
                        <td class="text-center">{{ $item->jumlah_produk }}</td>
                        <td class="text-end">Rp {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                        <td class="text-center">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
