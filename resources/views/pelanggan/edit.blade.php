@extends('layout')

@section('konten')

<div class="flex justify-center">
    <div class="w-full max-w-md">
        @if(session('success'))
            <div class="alert alert-success mb-4 shadow-sm rounded-lg px-4 py-3 text-green-700 bg-green-100 border border-green-300 flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M7.629 13.572l-3.292-3.293-1.414 1.415 4.706 4.707 9-9-1.415-1.414z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('pelanggan.update', $pelanggan->id) }}" class="bg-white rounded-2xl shadow p-6">
            @csrf
            @method('PUT')
            
            <div class="text-center mb-4">
                <h1 class="text-xl font-semibold text-gray-700">Edit Data Pelanggan</h1>
            </div>

            <div class="mb-3">
                <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" name="namapelanggan" class="form-control" value="{{ $pelanggan->namapelanggan }}" placeholder="Masukkan Nama Pelanggan" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat" required>{{ $pelanggan->alamat }}</textarea>
            </div>

            <div class="mb-4">
                <label for="nomortelepon" class="form-label">No Telepon</label>
                <input type="number" name="nomortelepon" class="form-control" value="{{ $pelanggan->nomortelepon }}" placeholder="Masukkan Nomor Telepon" required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('pelanggan.index') }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
