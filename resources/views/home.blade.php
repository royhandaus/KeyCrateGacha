@extends('base.base')

@section('title', 'Home')

@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container-fluid py-5" style="background-color: #3D3431; min-height: 100vh;">

  {{-- Banner utama dengan Carousel --}}
  <div class="row justify-content-center mb-5">
    <div class="col-md-10">
      <div id="crateCarousel" class="carousel slide rounded-4 shadow-lg" data-bs-ride="carousel" style="background-color: #FFF7C0; padding: 30px;">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#crateCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Celestic"></button>
    <button type="button" data-bs-target="#crateCarousel" data-bs-slide-to="1" aria-label="Dust Crate"></button>
    <button type="button" data-bs-target="#crateCarousel" data-bs-slide-to="2" aria-label="Ironfang Cache"></button>
    <button type="button" data-bs-target="#crateCarousel" data-bs-slide-to="3" aria-label="Nebula Vault"></button>
    <button type="button" data-bs-target="#crateCarousel" data-bs-slide-to="4" aria-label="Oracle Box"></button>
  </div>

  <div class="carousel-inner">

    {{-- Slide 1: Celestic --}}
    <div class="carousel-item active">
      <a href="{{ route('gacha', '6') }}" class="d-flex row align-items-center text-decoration-none text-dark">
        <div class="col-md-6 text-start">
          <h1 class="fw-bold display-5" style="font-family: 'Press Start 2P', monospace;">
            Your Destiny<br>Lies Within.
          </h1>
          <p class="lead mt-3" style="font-weight: 600; font-family: monospace;">
            Unlock divine rewards and rare treasures in the Celestic crate.
          </p>
        </div>
        <div class="col-md-6 text-center">
          <img src="{{ asset('Images/Celestic.png') }}" alt="Celestic Divine Box" class="img-fluid" style="max-width: 350px; height: auto;">
          <div class="mt-3 px-3 py-2 rounded-pill text-uppercase fw-bold" style="background-color: #3D3431; color: #FFF7C0; display: inline-block; letter-spacing: 2px;">
            Celestic (Divine)
          </div>
        </div>
      </a>
    </div>

    {{-- Slide 2: Dust Crate --}}
    <div class="carousel-item">
      <a href="{{ route('gacha', '1') }}" class="d-flex row align-items-center text-decoration-none text-dark">
        <div class="col-md-6 text-start">
          <h2 class="fw-bold display-6" style="font-family: 'Press Start 2P', monospace;">
            Dust Crate
          </h2>
          <p class="lead mt-3" style="font-weight: 600; font-family: monospace;">
            Affordable crate with solid rewards for casual players.
          </p>
        </div>
        <div class="col-md-6 text-center">
          <img src="{{ asset('Images/dust.png') }}" alt="Dust Crate" class="img-fluid" style="max-width: 350px; height: auto;">
          <div class="mt-3 px-3 py-2 rounded-pill text-uppercase fw-bold" style="background-color: #3D3431; color: #FFF7C0; display: inline-block; letter-spacing: 2px;">
            Dust (Rare)
          </div>
        </div>
      </a>
    </div>

    {{-- Slide 3: Ironfang Cache --}}
    <div class="carousel-item">
      <a href="{{ route('gacha', '2') }}" class="d-flex row align-items-center text-decoration-none text-dark">
        <div class="col-md-6 text-start">
          <h2 class="fw-bold display-6" style="font-family: 'Press Start 2P', monospace;">
            Ironfang Cache
          </h2>
          <p class="lead mt-3" style="font-weight: 600; font-family: monospace;">
            Elite crate with exclusive gear and epic prizes.
          </p>
        </div>
        <div class="col-md-6 text-center">
          <img src="{{ asset('Images/ironfang.png') }}" alt="Ironfang Cache" class="img-fluid" style="max-width: 350px; height: auto;">
          <div class="mt-3 px-3 py-2 rounded-pill text-uppercase fw-bold" style="background-color: #3D3431; color: #FFF7C0; display: inline-block; letter-spacing: 2px;">
            Ironfang (Elite)
          </div>
        </div>
      </a>
    </div>

    {{-- Slide 4: Nebula Vault --}}
    <div class="carousel-item">
      <a href="{{ route('gacha', '3') }}" class="d-flex row align-items-center text-decoration-none text-dark">
        <div class="col-md-6 text-start">
          <h2 class="fw-bold display-6" style="font-family: 'Press Start 2P', monospace;">
            Nebula Vault
          </h2>
          <p class="lead mt-3" style="font-weight: 600; font-family: monospace;">
            Reach new heights with rare treasures inside.
          </p>
        </div>
        <div class="col-md-6 text-center">
          <img src="{{ asset('Images/nebula.png') }}" alt="Nebula Vault" class="img-fluid" style="max-width: 350px; height: auto;">
          <div class="mt-3 px-3 py-2 rounded-pill text-uppercase fw-bold" style="background-color: #3D3431; color: #FFF7C0; display: inline-block; letter-spacing: 2px;">
            Nebula (Epic)
          </div>
        </div>
      </a>
    </div>

    {{-- Slide 5: Oracle Box --}}
    <div class="carousel-item">
      <a href="{{ route('gacha', '4') }}" class="d-flex row align-items-center text-decoration-none text-dark">
        <div class="col-md-6 text-start">
          <h2 class="fw-bold display-6" style="font-family: 'Press Start 2P', monospace;">
            Oracle Box
          </h2>
          <p class="lead mt-3" style="font-weight: 600; font-family: monospace;">
            Unlock mysterious powers and fate rewards.
          </p>
        </div>
        <div class="col-md-6 text-center">
          <img src="{{ asset('Images/oracle.png') }}" alt="Oracle Box" class="img-fluid" style="max-width: 350px; height: auto;">
          <div class="mt-3 px-3 py-2 rounded-pill text-uppercase fw-bold" style="background-color: #3D3431; color: #FFF7C0; display: inline-block; letter-spacing: 2px;">
            Oracle (Fate)
          </div>
        </div>
      </a>
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#crateCarousel" data-bs-slide="prev" style="width: 50px;">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#crateCarousel" data-bs-slide="next" style="width: 50px;">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


    </div>
  </div>

  {{-- Fitur singkat --}}
  <div class="row justify-content-center mb-5">
    <div class="col-md-10">
      <h3 class="text-warning fw-bold mb-4" style="font-family: 'Press Start 2P', monospace;">Why Play with Us?</h3>
      <div class="row g-4 text-center text-dark">
        <div class="col-md-4">
          <div class="p-4 rounded-4 shadow-sm" style="background-color: #FFF7C0;">
            <i class="bi bi-controller display-3 mb-3"></i>
            <h5>Exciting Gameplay</h5>
            <p>Engage with unique crates and exclusive prizes every day.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 rounded-4 shadow-sm" style="background-color: #FFF7C0;">
            <i class="bi bi-wallet2 display-3 mb-3"></i>
            <h5>Secure Payments</h5>
            <p>Easy and trusted payment methods to support your gaming.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 rounded-4 shadow-sm" style="background-color: #FFF7C0;">
            <i class="bi bi-award display-3 mb-3"></i>
            <h5>Exclusive Rewards</h5>
            <p>Win rare items and grand prizes with every crate opened.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Footer --}}
  <footer class="text-center py-4" style="color: #FFF7C0;">
    &copy; {{ date('Y') }} KeyCrate - Your Gateway to Destiny.
  </footer>

</div>

@endsection
