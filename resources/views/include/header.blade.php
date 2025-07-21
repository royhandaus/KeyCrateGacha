<nav class="navbar navbar-expand-lg navbar-dark shadow-0" style="background-color: #3D3431;">
  <div class="container">
    
    {{-- Logo Toko --}}
    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
      <img src="{{ asset('Images/Keycrate_logo.png') }}" alt="KeyCrate Logo" class="rounded-circle me-2" width="50">
    </a>

    {{-- Burger Menu (mobile only) --}}
    <button class="navbar-toggler text-warning ms-auto d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars fs-3"></i>
    </button>

    {{-- Navigasi --}}
    <div class="collapse navbar-collapse" id="navbarMain">
      {{-- Menu Navigasi Kiri --}}
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link px-3 gold-text {{ request()->is('/') ? 'fw-bold' : '' }}" href="{{ route('home') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link px-3 gold-text {{ request()->routeIs('store') ? 'fw-bold' : '' }}" href="{{ route('store') }}">Shop</a></li>
        <li class="nav-item"><a class="nav-link px-3 gold-text {{ request()->routeIs('crates') ? 'fw-bold' : '' }}" href="{{ route('crates') }}">Gacha</a></li>

        @auth
          @if (Auth::user()->user_role === 'user')
            <li class="nav-item"><a class="nav-link px-3 gold-text {{ request()->routeIs('inventory') ? 'fw-bold' : '' }}" href="{{ route('inventory') }}">Inventory</a></li>
            <li class="nav-item"><a class="nav-link px-3 gold-text {{ request()->routeIs('gacha.history') ? 'fw-bold' : '' }}" href="{{ route('gacha.history') }}">Gacha History</a></li>
            <li class="nav-item"><a class="nav-link px-3 gold-text {{ request()->routeIs('history') ? 'fw-bold' : '' }}" href="{{ route('history') }}">Purchase History</a></li>
          @elseif (Auth::user()->user_role === 'seller')
            <li class="nav-item position-relative">
              <a class="nav-link px-3 gold-text {{ request()->routeIs('product') ? 'fw-bold' : '' }}" href="{{ route('product') }}">
                Product
                @if(isset($outOfStockProducts) && $outOfStockProducts > 0)
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $outOfStockProducts }}
                    <span class="visually-hidden">Produk habis</span>
                  </span>
                @endif
              </a>
            </li>
            <li class="nav-item"><a class="nav-link px-3 gold-text {{ request()->routeIs('sales.index') ? 'fw-bold' : '' }}" href="{{ route('sales.index') }}">Sales Report</a></li>
            <li class="nav-item"><a class="nav-link px-3 gold-text {{ request()->routeIs('gacha.seller.history') ? 'fw-bold' : '' }}" href="{{ route('gacha.seller.history') }}">Gacha Report</a></li>
          @endif
        @endauth
      </ul>

      {{-- Bagian Kanan (PC Only) --}}
      <ul class="navbar-nav align-items-center d-none d-lg-flex">
        @auth
          @if (Auth::user()->user_role === 'user')
            <li class="nav-item"><a class="nav-link px-2" href="{{ route('wishlist.index') }}"><i class="bi bi-heart-fill text-danger fs-5"></i></a></li>
            <li class="nav-item"><a class="nav-link px-2" href="{{ route('cart') }}"><i class="bi bi-cart text-warning fs-5"></i></a></li>
          @endif
        @endauth
        <li class="nav-item"><a class="nav-link px-2" href="https://www.youtube.com/@MochammadRoyha" target="_blank"><i class="fab fa-youtube gold-text"></i></a></li>
        <li class="nav-item"><a class="nav-link px-2" href="https://www.instagram.com/daffrazq_"><i class="fab fa-instagram gold-text"></i></a></li>
        <li class="nav-item text-end pe-3">
          <div class="gold-text" style="font-size: 1rem;">Welcome, {{ Auth::user()->nama_user ?? 'Guest' }}</div>
          <div class="gold-text" style="font-size: 0.85rem;">Test Your Luck Now!</div>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle gold-text" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle fa-2x"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
            <li class="px-3 py-2">
              <strong>{{ Auth::user()->nama_user ?? 'Guest' }}</strong><br>
              <small class="text-muted">{{ Auth::user()->user_email ?? '' }}</small>
              @auth
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                  @csrf
                  <button type="submit" class="btn btn-warning btn-sm w-100">Logout</button>
                </form>
              @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm mt-2 w-100">Login</a>
              @endauth
            </li>
          </ul>
        </li>
      </ul>

      {{-- Bagian Kanan (Mobile Only, muncul setelah burger ditekan) --}}
      <ul class="navbar-nav align-items-start d-lg-none w-100 mt-3 border-top pt-3">
        @auth
          @if (Auth::user()->user_role === 'user')
            <li class="nav-item"><a class="nav-link px-3 py-2 gold-text" href="{{ route('wishlist.index') }}"><i class="bi bi-heart-fill text-danger me-2"></i> Wishlist</a></li>
            <li class="nav-item"><a class="nav-link px-3 py-2 gold-text" href="{{ route('cart') }}"><i class="bi bi-cart text-warning me-2"></i> Cart</a></li>
          @endif
        @endauth
        <li class="nav-item"><a class="nav-link px-3 py-2 gold-text" href="https://www.youtube.com/@MochammadRoyha" target="_blank"><i class="fab fa-youtube me-2"></i> YouTube</a></li>
        <li class="nav-item"><a class="nav-link px-3 py-2 gold-text" href="https://www.instagram.com/daffrazq_"><i class="fab fa-instagram me-2"></i> Instagram</a></li>
        
        {{-- Mobile Account Info --}}
        <li class="nav-item border-top mt-3 pt-2 w-100">
          <div class="px-3 py-2">
            <strong class="gold-text">{{ Auth::user()->nama_user ?? 'Guest' }}</strong>
            @auth
              <small class="d-block text-muted">{{ Auth::user()->user_email }}</small>
              <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm w-100">Logout</button>
              </form>
            @else
              <a href="{{ route('login') }}" class="btn btn-primary btn-sm mt-2 w-100">Login</a>
            @endauth
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
