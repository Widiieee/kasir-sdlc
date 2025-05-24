@extends('layout')

@section('konten')

<div class="flex justify-center">
    <div class="w-full max-w-md">
        @if ($errors->any())
            <div class="alert alert-danger mb-4 shadow-sm rounded-lg px-4 py-3 text-red-700 bg-red-100 border border-red-300 flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M7.629 13.572l-3.292-3.293-1.414 1.415 4.706 4.707 9-9-1.415-1.414z"/>
                </svg>
                <span>
                    <ul class="mb-0 list-disc ps-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </span>
            </div>
        @endif

        <form action="{{ route('user.update', $user->id) }}" method="POST" class="bg-white rounded-2xl shadow p-6">
            @csrf
            @method('PUT')

            <div class="text-center mb-4">
                <h1 class="text-xl font-semibold text-gray-700">Edit User</h1>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-4">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('user.index') }}" class="btn btn-sm btn-secondary">
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
