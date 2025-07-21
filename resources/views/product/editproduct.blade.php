@extends('base.base')

@section('content')
<style>
    html, body {
      background-color: #2b2522;
      color: #f5f5f5;
      font-family: 'Segoe UI', sans-serif;
    }
</style>

<div class="container mt-5" style="max-width: 700px;">
    <div class="p-4 rounded shadow" style="background-color: #1e1e2f;">
        <h4 class="mb-4 text-warning"><i class="bi bi-pencil-square me-2"></i> Edit Product</h4>

        <form method="POST" action="{{ route('product.update', $product->produk_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label text-light">Nama Produk</label>
                <input type="text" class="form-control bg-dark text-white border-warning" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Stok Produk</label>
                <input type="number" class="form-control bg-dark text-white border-warning" name="stok_produk" value="{{ old('stok_produk', $product->stok_produk) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Redeem Code</label>
                <input type="string" class="form-control bg-dark text-white border-warning" name="kode_redeem_produk" value="{{ old('kode_redeem_produk', $product->kode_redeem_produk) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Rating</label>
                <input type="number" class="form-control bg-dark text-white border-warning" name="rating" min="0" max="5" value="{{ old('rating', $product->rating) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Ketersediaan Produk</label>
                <select name="available_produk" class="form-control bg-dark text-white border-warning" required>
                    <option value="1">Tersedia</option>
                    <option value="0">Tidak Tersedia</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i> Update
                </button>
                <a href="{{ route('product') }}" class="btn btn-outline-danger">
                    <i class="bi bi-x-circle me-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
