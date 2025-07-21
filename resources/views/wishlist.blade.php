@extends('base.base')

@section('title', 'Wishlist')

@section('content')
<style>
    .wishlist-card {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        border: 2px solid #ffc107;
        border-radius: 14px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 0 20px rgba(255, 193, 7, 0.15);
    }

    .wishlist-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0 25px rgba(255, 193, 7, 0.4);
    }

    .wishlist-card img {
        height: 180px;
        object-fit: contain;
        background-color: #fff;
        padding: 10px;
        border-bottom: 1px solid #ffc10733;
    }

    .wishlist-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #ffe082;
    }

    .wishlist-price {
        font-size: 0.95rem;
        color: #ccc;
        margin-bottom: 12px;
    }

    .btn-wishlist {
        font-size: 0.85rem;
        padding: 6px 12px;
    }
</style>

<div class="container my-4">
    <h2 class="mb-4 text-white text-center" style="font-weight: bold;">🌟 Your Wishlist</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @if(count($wishlists) > 0)
    <div class="row justify-content-center">
        @foreach($wishlists as $wishlist)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="wishlist-card h-100 d-flex flex-column justify-content-between">
                    <img src="{{ asset('Images/' . $wishlist->key->image_key) }}" class="img-fluid" alt="{{ $wishlist->key->nama_key }}">
                    <div class="p-3 d-flex flex-column justify-content-between text-center">
                        <div>
                            <div class="wishlist-title mb-2">{{ $wishlist->key->nama_key }}</div>
                            <div class="wishlist-price">Harga: IDR {{ number_format($wishlist->key->harga_key, 0, ',', '.') }}</div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <form action="{{ route('wishlist.moveToCart', $wishlist->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm btn-wishlist">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </form>
                            <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-wishlist">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
        <p class="text-white text-center mt-5">✨ Wishlist kamu masih kosong. Yuk cari item favoritmu!</p>
    @endif
</div>
@endsection
