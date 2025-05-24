@extends('layout')

@section('konten')
<div class="container-fluid mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-bold mb-4 md:mb-0">Daftar Barang</h1>
        <div class="flex gap-2">
            <a href="cetakProduk" target="_blank" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-print fa-sm text-white-50"></i> Cetak Data
            </a>
            <a href="{{ route('produk.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk
            </a>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show flex items-center gap-2" role="alert">
            <i class="fas fa-check-circle text-success"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow p-4 overflow-x-auto">
        <table class="table table-bordered w-full text-sm">
            <thead class="bg-gray-100 text-center">
                <tr>
                    <th class="py-2 px-3">No</th>
                    <th class="py-2 px-3">Nama Produk</th>
                    <th class="py-2 px-3">Harga Jual</th>
                    <th class="py-2 px-3">Stok</th>
                    <th class="py-2 px-3">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk as $p)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-3 text-center">{{ ($produk->currentPage() - 1) * $produk->perPage() + $loop->iteration }}</td>
                    <td class="py-2 px-3">{{ $p->namaproduk }}</td>
                    <td class="py-2 px-3">Rp {{ number_format($p->harga_jual, 0, ',', '.') }}</td>
                    <td class="py-2 px-3 text-center">{{ $p->stok }}</td>
                    <td class="py-2 px-3 text-center space-x-1">

                        <a href="{{ route('produk.show', $p->id) }}" class="btn btn-outline-info btn-sm inline-flex items-center space-x-1">
                            <i class="fas fa-eye"></i>
                            <span>Detail</span>
                        </a>

                        <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-outline-primary btn-sm inline-flex items-center justify-center" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('produk.destroy', $p->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm inline-flex items-center justify-center" 
                                onclick="return confirm('Yakin ingin menghapus produk ini?')" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $produk->links() }}
        </div>
    </div>
</div>
@endsection
