@extends('layout')

@section('konten')
<div class="container-fluid mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-bold mb-4 md:mb-0">Manajemen Petugas</h1>
        <a href="{{ route('kasir.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Petugas
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show flex items-center gap-2" role="alert">
            <i class="fas fa-check-circle text-success"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="bg-white rounded-2xl shadow p-4 overflow-x-auto">
        <div class="overflow-x-auto">
            <table class="table table-bordered w-full text-sm">
                <thead class="bg-gray-100 text-center">
                    <tr>
                        <th class="py-3 px-4">Nama</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Role</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user as $u)
                    <tr class="text-center align-middle">
                        <td class="py-2 px-3">{{ $u->nama }}</td>
                        <td class="py-2 px-3">{{ $u->email }}</td>
                        <td class="py-2 px-3">
                            @php
                                $badgeColor = match($u->role) {
                                    'admin' => 'bg-success bg-opacity-25 text-light',
                                    'petugas' => 'bg-primary bg-opacity-25 text-light',
                                };
                            @endphp

                            <span class="badge {{ $badgeColor }} text-capitalize">
                                {{ $u->role }}
                            </span>
                        </td>
                        <td class="py-2 px-3">
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="{{ route('user.edit', $u->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                {{-- <a href="{{ route('user.reset-password', $u->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-key"></i> Reset
                                </a> --}}
                                <form action="{{ route('user.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-3">Belum ada data petugas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
