<!DOCTYPE html>
<html>
<head>
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: "Courier New", Courier, monospace;
            font-size: 12px;
            margin: 0;
            padding: 10px;
            background: #fff;
        }
        .nota {
            width: 320px;  /* sekitar lebar kertas thermal */
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #000;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-weight: bold;
            font-size: 18px;
        }
        .header p {
            margin: 2px 0;
            font-size: 10px;
        }
        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table tr td {
            padding: 2px 0;
        }
        .produk {
            text-align: left;
            width: 60%;
        }
        .qty {
            text-align: center;
            width: 15%;
        }
        .subtotal {
            text-align: right;
            width: 25%;
        }
        .total {
            font-weight: bold;
            font-size: 14px;
            text-align: right;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="nota">
        <div class="header">
            <h2>SHOPKEY</h2>
            <p>Semarang Kidul, Banjarnegara</p>
            <p>Telp: 0812-3456-7890</p>
        </div>
        <p>Tanggal: {{ $penjualan->tanggal_penjualan }}</p>
        <p>Pelanggan: {{ $penjualan->pelanggan->namapelanggan ?? 'Umum' }}</p>
        <hr>
        <table>
            @foreach($penjualan->detail_penjualan as $item)
            <tr>
                <td class="produk">{{ $item->produk->namaproduk }}</td>
                <td class="qty">{{ $item->jumlah_produk }}</td>
                <td class="subtotal">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>
        <p class="total">Total: Rp{{ number_format($penjualan->total_harga, 0, ',', '.') }}</p>
        <div class="footer">
            Terima kasih atas kunjungan Anda.<br>
            Semoga hari Anda menyenangkan!
        </div>
    </div>
</body>
</html>
