@extends('layout')

@section('konten')
<div class="container mx-auto my-6 px-4">
  <h1 class="text-3xl font-bold text-primary mb-6 text-center">Transaksi Penjualan</h1>

  @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show flex items-center gap-2" role="alert">
            <i class="fas fa-check-circle text-success"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
          localStorage.removeItem("keranjang");
          setTimeout(() => window.open("{{ route('transaksi.cetak', session('id_penjualan')) }}","_blank"), 1000);
        </script>
    @endif

  {{-- Info & Pelanggan --}}
  <div class="bg-white shadow rounded-2xl mb-6 overflow-hidden">
    <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div>
        <label class="form-label fw-semibold mb-1">Tanggal</label>
        <input type="date" id="tanggal_penjualan" name="tanggal_penjualan" class="form-control" value="{{ date('Y-m-d') }}">
      </div>
      <div>
        <label class="form-label fw-semibold mb-1">Pelanggan</label>
        <select id="idpelanggan" name="idpelanggan" class="form-select form-select-lg shadow-sm rounded-md">
          <option value="">-- Pilih Pelanggan --</option>
          @foreach($pelanggan as $p)
            <option value="{{ $p->id }}">{{ $p->namapelanggan }}</option>
          @endforeach
        </select>
      </div>

      <div class="lg:col-span-2">
        <h6 class="fw-semibold mb-2">Tambah Pelanggan Baru</h6>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <input type="text" name="pelanggan_baru_nama" class="form-control" placeholder="Nama Pelanggan">
          <input type="text" name="pelanggan_baru_alamat" class="form-control" placeholder="Alamat">
          <input type="text" name="pelanggan_baru_nomor" class="form-control" placeholder="Nomor Telepon">
        </div>
      </div>
    </div>
  </div>

  {{-- Cari & Pilih Produk --}}
  <div class="bg-white shadow rounded-2xl mb-6 p-6">
    <h5 class="mb-4 fw-semibold">Cari & Pilih Produk</h5>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-end">
      
      {{-- Kolom Pencarian --}}
      <div>
        <div class="input-group shadow-sm rounded-md overflow-hidden">
          <input type="text" id="searchKeyword" class="form-control border-0" placeholder="Cari produk..." autocomplete="off">
          <button class="btn btn-primary" onclick="searchProduk()">Cari</button>
        </div>
        <ul id="hasilCari" class="list-group mt-2 shadow-sm rounded-md max-h-48 overflow-y-auto"></ul>
      </div>
      
      {{-- Dropdown Pilih Produk --}}
      <div>
          <label for="produk_id" class="form-label fw-semibold mb-1">Pilih Produk</label>
          <select name="produk_id" id="produk" class="form-select form-select-lg shadow-sm rounded-md">
              <option value="">-- Pilih Produk --</option>
              @foreach($produk as $produk)
                  <option value="{{ $produk->id }}"
                      data-nama="{{ $produk->namaproduk }}"
                      data-harga="{{ $produk->harga_jual }}">
                      {{ $produk->namaproduk }} (Stok: {{ $produk->stok }})
                  </option>
              @endforeach
          </select>
      </div>

      {{-- Jumlah & Tombol Tambah --}}
      <div class="grid grid-cols-2 gap-4 lg:col-span-2">
        <input type="number" id="jumlah_produk" name="jumlah_produk" class="form-control form-control-lg rounded-md" value="1" min="1">
        <button class="btn btn-primary btn-lg w-full" onclick="tambahKeKeranjang()">+ Tambah</button>
      </div>
    </div>
  </div>


  {{-- Keranjang --}}
  <div class="bg-white shadow rounded-2xl mb-6 p-6">
    <h5 class="mb-4 fw-semibold">Keranjang</h5>
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="keranjang-body"></tbody>
      </table>
    </div>
  </div>

  {{-- Total & Pembayaran --}}
  <div class="bg-white shadow rounded-2xl p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div>
        <label class="form-label fw-semibold mb-1">Total</label>
        <input type="text" id="total-harga-tampil" class="form-control fs-4 fw-bold text-success" readonly value="Rp0">
      </div>
      <div>
        <label class="form-label fw-semibold mb-1">Bayar</label>
        <input type="number" id="bayar" class="form-control" placeholder="Jumlah uang" min="0">
      </div>
      <div>
        <label class="form-label fw-semibold mb-1">Kembalian</label>
        <input type="text" id="kembalian" class="form-control fs-4 fw-bold text-danger" readonly value="Rp0">
      </div>
    </div>

    <form action="{{ route('penjualan.store') }}" method="POST" class="mt-6" onsubmit="return submitTransaksi(this)">
      @csrf
      <input type="hidden" id="input_tanggal_penjualan" name="tanggal_penjualan">
      <input type="hidden" id="input_idpelanggan" name="idpelanggan">
      <input type="hidden" id="hidden_pelanggan_nama" name="pelanggan_baru_nama">
      <input type="hidden" id="hidden_pelanggan_alamat" name="pelanggan_baru_alamat">
      <input type="hidden" id="hidden_pelanggan_nomor" name="pelanggan_baru_nomor">
      <input type="hidden" id="total_harga_input" name="total_harga" value="0">
      <input type="hidden" id="keranjang_input" name="keranjang">

      <button type="submit" class="btn btn-success btn-lg w-full">Simpan Transaksi</button>
    </form>

    @if ($errors->any())
      <div class="alert alert-danger mt-4 shadow-sm rounded-lg">
        <strong>Ada kesalahan saat mengisi form:</strong>
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
</div>
<script>
    let keranjang = [];

    const produkSelect = document.getElementById('produk');
    const semuaOption = Array.from(produkSelect.options);

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(angka);
    }

    function updateKembalian() {
        const total = parseInt(document.getElementById('total_harga_input').value) || 0;
        const bayar = parseInt(document.getElementById('bayar').value) || 0;
        const kembali = bayar - total;
        document.getElementById('kembalian').value = formatRupiah(kembali > 0 ? kembali : 0);
    }

    function updateTampilanKeranjang() {
        let body = document.getElementById('keranjang-body');
        let total = 0;
        body.innerHTML = '';

        keranjang.forEach((item, index) => {
            let subtotal = item.harga * item.jumlah_produk;
            total += subtotal;

            body.innerHTML += `
                <tr>
                    <td>${item.nama}</td>
                    <td>${formatRupiah(item.harga)}</td>
                    <td>${item.jumlah_produk}</td>
                    <td>${formatRupiah(subtotal)}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusItem(${index})">Hapus</button></td>
                </tr>
            `;
        });

        document.getElementById('total-harga-tampil').value = formatRupiah(total);
        document.getElementById('total_harga_input').value = total;
        document.getElementById('keranjang_input').value = JSON.stringify(keranjang);

        updateKembalian(); // Pastikan kembalian selalu update
    }

    function tambahKeKeranjang() {
    const select = document.getElementById('produk');
    const selected = select.options[select.selectedIndex];
    const idproduk = select.value;

    if (!idproduk) {
        alert('Pilih produk terlebih dahulu!');
        return;
    }

    const nama = selected.dataset.nama;
    const harga = parseInt(selected.dataset.harga);
    const stok = parseInt(selected.textContent.match(/Stok: (\d+)/)[1]); // Ambil stok dari teks
    const jumlah = parseInt(document.getElementById('jumlah_produk').value || 1);

    if (jumlah <= 0) {
        alert('Jumlah harus lebih dari 0');
        return;
    }

    // Hitung total jumlah produk ini di keranjang
    const existing = keranjang.find(p => p.idproduk === idproduk);
    const totalSudahAda = existing ? existing.jumlah_produk : 0;

    if (jumlah + totalSudahAda > stok) {
        alert(`Jumlah melebihi stok tersedia! Hanya ada ${stok - totalSudahAda} stok yang tersedia.`);
        return;
    }

    if (existing) {
        existing.jumlah_produk += jumlah;
    } else {
        keranjang.push({ idproduk, nama, harga, jumlah_produk: jumlah });
    }

    updateTampilanKeranjang();
}


    function hapusItem(index) {
        keranjang.splice(index, 1);
        updateTampilanKeranjang();
    }

    function searchProduk() {
        const keyword = document.getElementById('searchKeyword').value.trim();

        if(keyword === '') {
            document.getElementById('hasilCari').innerHTML = '';
            return;
        }

        fetch(`/penjualan/search?keyword=${encodeURIComponent(keyword)}`)
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('hasilCari');
                list.innerHTML = '';

                if(data.length === 0){
                    list.innerHTML = '<li class="list-group-item">Tidak ada produk ditemukan</li>';
                    return;
                }

                data.forEach(produk => {
                    const li = document.createElement('li');
                    li.classList.add('list-group-item', 'list-group-item-action');
                    li.style.cursor = 'pointer';
                    li.textContent = `${produk.namaproduk} - Stok: ${produk.stok}`;

                    li.addEventListener('click', () => {
                        for(let option of produkSelect.options) {
                            if(option.value == produk.id) {
                                produkSelect.value = produk.id;
                                break;
                            }
                        }
                        list.innerHTML = '';
                        document.getElementById('searchKeyword').value = '';
                    });

                    list.appendChild(li);
                });
            })
            .catch(err => console.error('Error:', err));
    }

    document.getElementById('searchKeyword').addEventListener('input', function() {
        if (this.value.trim() === '') {
            document.getElementById('hasilCari').innerHTML = '';
            return;
        }
        searchProduk();
    });

    // Update kembalian setiap input pada field bayar
    document.getElementById('bayar').addEventListener('input', updateKembalian);

      function submitTransaksi(form) {
      const total = parseInt(document.getElementById('total_harga_input').value) || 0;
      const bayar = parseInt(document.getElementById('bayar').value) || 0;

      if (keranjang.length === 0) {
          alert("Keranjang masih kosong. Tambahkan produk terlebih dahulu.");
          return false;
      }

      if (bayar === 0 || isNaN(bayar)) {
          alert("Masukkan jumlah uang yang dibayarkan.");
          return false;
      }

      if (bayar < total) {
          alert("Uang yang dibayarkan kurang dari total harga.");
          return false;
      }

      // Set input hidden untuk dikirim ke backend
      document.getElementById('input_tanggal_penjualan').value = document.getElementById('tanggal_penjualan').value;
      document.getElementById('input_idpelanggan').value = document.getElementById('idpelanggan').value;
      document.getElementById('hidden_pelanggan_nama').value = document.querySelector('[name="pelanggan_baru_nama"]').value;
      document.getElementById('hidden_pelanggan_alamat').value = document.querySelector('[name="pelanggan_baru_alamat"]').value;
      document.getElementById('hidden_pelanggan_nomor').value = document.querySelector('[name="pelanggan_baru_nomor"]').value;

      return true; // lanjutkan submit
  }


    updateTampilanKeranjang(); // Initial load
</script>

@endsection
