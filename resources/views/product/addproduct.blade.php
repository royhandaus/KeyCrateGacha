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
        <h4 class="mb-4 text-warning"><i class="bi bi-box-seam me-2"></i> Add New Product</h4>

        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label text-light">Nama Produk</label>
                <input type="text" class="form-control bg-dark text-white border-warning" name="nama_produk" placeholder="e.g., Steam Voucher 20k" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Stok Produk</label>
                <input type="number" class="form-control bg-dark text-white border-warning" name="stok_produk" placeholder="e.g., 10" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Kode Redeem Produk</label>
                <input type="text" class="form-control bg-dark text-white border-warning" name="kode_redeem_produk" placeholder="e.g., ABC123" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Rating</label>
               <input type="number" name="rating" class="form-control bg-dark text-white border-warning" min="0" max="5" value="0" />

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
                    <i class="bi bi-check-circle me-1"></i> Save
                </button>
                <a href="{{ route('product') }}" class="btn btn-outline-danger">
                    <i class="bi bi-x-circle me-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
