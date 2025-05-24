@extends('layout')

@section('konten')
<div class="container mx-auto px-4">
    {{-- Tombol Tambah Member --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold mb-4 md:mb-0">Daftar Pelanggan</h1>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Member
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show flex items-center gap-2" role="alert">
            <i class="fas fa-check-circle text-success"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    {{-- Tabel Data Pelanggan --}}
    <div class="bg-white rounded-2xl shadow p-4 overflow-x-auto">
        <table class="table table-bordered w-full text-sm">
            <thead class="bg-gray-100 text-center">
                <tr>
                    <th class="py-2 px-3">Nama Pelanggan</th>
                    <th class="py-2 px-3">Alamat</th>
                    <th class="py-2 px-3">No Telepon</th>
                    <th class="py-2 px-3">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelanggan as $p)
                <tr class="text-center">
                    <td class="py-2 px-3">{{ $p->namapelanggan }}</td>
                    <td class="py-2 px-3">{{ $p->alamat }}</td>
                    <td class="py-2 px-3">{{ $p->nomortelepon }}</td>
                    <td class="py-2 px-3 space-x-1">
                        <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('pelanggan.show', $p->id) }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                        <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </td>                            
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
