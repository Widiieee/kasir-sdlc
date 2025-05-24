@extends('layout')

@section('konten')
<div class="container">
    <h2>Update Stok Produk</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('produk.update-stok-post', $produk->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="stok">Stok Baru:</label>
            <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok', $produk->stok) }}" required min="0">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Stok</button>
    </form>
</div>
@endsection
