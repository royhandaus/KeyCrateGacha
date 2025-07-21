@extends('base.base')

@section('title', 'Store Page')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    background-color: #2b2522;
    color: #f5f5f5;
    font-family: 'Segoe UI', sans-serif;
  }

  .store-header {
    background-color: #3D3431;
    padding: 1rem 2rem;
    margin: 20px auto;
    border-radius: 10px;
    max-width: 1100px;
    box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
    text-align: center;
  }

  .store-header h2 {
    color: #ffd700;
    margin-bottom: 15px;
  }

  .search-form, .filter-form {
    max-width: 400px;
    margin: 0 auto 15px;
  }

  .search-form input, .filter-form input {
    width: 100%;
    border-radius: 50px;
    padding: 10px 15px;
    font-size: 1.1rem;
    border: none;
    outline: none;
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.6);
    background-color: #3d3431;
    color: #fff;
    transition: box-shadow 0.3s ease;
  }

  .search-form input::placeholder, .filter-form input::placeholder {
    color: #ffd700cc;
  }

  .search-form input:focus, .filter-form input:focus {
    box-shadow: 0 0 20px #ffd700;
    background-color: #4a3a36;
  }

  .store-grid {
    max-width: 1100px;
    margin: 0 auto 60px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 1.5rem;
    padding: 0 15px;
  }

  .store-card {
    background: linear-gradient(to bottom, #352d29, #4b403b);
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.5);
    text-align: center;
    color: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    min-height: 390px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    opacity: 1;
  }

  .store-card.inactive {
    opacity: 0.5;
  }

  .image-wrapper {
    background-color: #fff8dc;
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
  }

  .image-wrapper img {
    max-width: 100%;
    max-height: 160px;
    object-fit: contain;
    border-radius: 8px;
  }

  .store-card h5 {
    margin-bottom: 0.5rem;
    font-weight: 700;
    color: #ffecc4;
  }

  .store-card p {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1a1a1a;
    background-color: #fff7c0;
    padding: 8px 14px;
    border-radius: 10px;
    display: inline-block;
    margin-bottom: 10px;
  }

  .btn-group button {
    border-radius: 10px;
    font-size: 1.2rem;
    width: 100px;
    height: 48px;
    padding: 0;
    margin: 0 6px;
  }

  .btn-outline-success {
    color: #28a745;
    border-color: #28a745;
  }

  .btn-outline-success:hover {
    background-color: #28a745;
    color: #fff;
  }

  .btn-outline-danger {
    color: #dc3545;
    border-color: #dc3545;
  }

  .btn-outline-danger:hover {
    background-color: #dc3545;
    color: #fff;
  }

  .favorite-icon {
    position: absolute;
    top: 12px;
    right: 12px;
    font-size: 22px;
    color: #ccc;
    cursor: pointer;
    transition: color 0.3s;
    z-index: 10;
  }

  .favorite-icon.active {
    color: #ff4d4d;
  }

  .crate-badge {
    margin-top: 8px;
    font-size: 0.9rem;
    color: #FFD700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }

  .crate-badge img {
    width: 22px;
    height: 22px;
    border-radius: 4px;
    object-fit: cover;
    border: 1px solid #aaa;
  }
</style>

<div class="store-header">
  <h2>Key Store</h2>
  <form action="{{ route('store') }}" method="GET" class="search-form" role="search" autocomplete="off">
    <input type="text" name="query" class="form-control" placeholder="Search keys..." value="{{ request('query') }}">
  </form>
  <form action="{{ route('store') }}" method="GET" class="filter-form">
    <div class="d-flex gap-2 mt-2">
      <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">
      <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
      <button type="submit" class="btn btn-warning px-3">Filter</button>
    </div>
  </form>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mx-auto" style="max-width:1100px;" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="store-grid">
  @forelse ($keys as $key)
    @if(Auth::check() && Auth::user()->user_role === 'seller' || ($key->status === 'active' && $key->deleted != 1))
    <div class="store-card {{ $key->status === 'inactive' ? 'inactive' : '' }}" onclick="location.href='{{ Auth::check() && Auth::user()->user_role === 'seller' ? url('/crate/edit/' . $key->crate_id) : '#' }}'">
      <div class="image-wrapper">
        <img src="{{ asset('Images/' . $key->image_key) }}" alt="{{ $key->nama_key }}">
      </div>
      <h5>{{ $key->nama_key }}</h5>
      <p>IDR {{ number_format($key->harga_key, 0, ',', '.') }}</p>

      @if($key->crate)
        <div class="crate-badge">
          <img src="{{ asset('images/' . $key->crate->crate_image) }}" alt="Crate">
          {{ strtoupper($key->crate->name) }}
        </div>
      @endif

      @if(Auth::check() && Auth::user()->user_role === 'user')
      <div class="d-flex flex-column gap-2 mt-3">
        <form action="{{ route('add_to_cart', $key->id) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-success w-100" title="Buy">
            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
          </button>
        </form>

        <form action="{{ route('wishlist.add', $key->id) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-warning w-100" title="Add to Wishlist">
            <i class="fas fa-heart me-2"></i> Wishlist
          </button>
        </form>
      </div>
      @endif
    </div>
    @endif
  @empty
  <p class="text-center text-white fs-5" style="grid-column:1/-1;">No keys found.</p>
  @endforelse
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
