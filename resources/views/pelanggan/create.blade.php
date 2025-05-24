@extends('layout')

@section('konten')

<div class="flex justify-center">
    <form method="POST" action="{{ route('pelanggan.store') }}" class="w-full max-w-md">
        @csrf
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="text-center mb-4">
                <h1 class="text-xl font-semibold text-gray-700">Tambah Data Pelanggan</h1>
            </div>

            <div class="mb-3">
                <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" name="namapelanggan" class="form-control" placeholder="Masukkan Nama pelanggan" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
            </div>

            <div class="mb-4">
                <label for="nomortelepon" class="form-label">No Telepon</label>
                <input type="number" name="nomortelepon" class="form-control" placeholder="Masukkan nomor telepon" required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('pelanggan.index') }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
