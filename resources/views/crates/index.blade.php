@extends('base.base')

@section('title', 'Crates Page')

@section('content')
  <style>
    html {
      background-color: #2b2522;
    }
    body {
      background-color: #2b2522;
      color: #f5f5f5;
      font-family: 'Segoe UI', sans-serif;
      text-align: center;
    }

    h1 {
      font-size: 42px;
      font-weight: bold;
      color: #ffd700;
      margin-bottom: 40px;
      text-shadow: 2px 2px #000;
    }

    .crate-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 35px;
      max-width: 1100px;
      margin: auto;
      margin-bottom: 60px;
    }

    .crate-box {
      background: linear-gradient(to bottom, #3a2f2b, #4b3e39);
      border: 2px solid rgba(255, 255, 255, 0.1);
      border-radius: 14px;
      padding: 20px;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
      height: 280px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
    }

    .crate-box:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 0 28px rgba(255, 204, 0, 0.4);
      border-color: #ffd700;
    }

    .crate-box img {
      width: 100%;
      height: 160px;
      object-fit: contain;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.35);
    }

    .crate-label {
      margin-top: 15px;
      font-size: 18px;
      font-weight: 600;
      letter-spacing: 1px;
      color: #ffecc4;
      text-shadow: 1px 1px #000;
      text-align: center;
    }

    .key-badge {
      position: absolute;
      top: 8px;
      right: 8px;
      background: gold;
      color: black;
      padding: 4px 8px;
      font-size: 13px;
      border-radius: 10px;
      box-shadow: 0 0 8px #000;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    @media (max-width: 600px) {
      h1 {
        font-size: 28px;
      }

      .crate-label {
        font-size: 16px;
      }
    }
  </style>

  @if(Auth::check() && Auth::user()->user_role === 'seller')
    <h1>Your Crate</h1>
  @else
    <h1>Select a Crate to open</h1>
  @endif

  <div class="crate-grid">
    @if(Auth::check() && Auth::user()->user_role === 'seller')
      <div class="crate-box d-flex flex-column justify-content-center align-items-center" style="border: 2px dashed #ffd700; height: 280px;">
        <a href="{{ url('/crate/add') }}" class="text-decoration-none text-warning d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
          <i class="fas fa-plus-circle fa-3x mb-2"></i>
          <div class="crate-label">Add New Crate</div>
        </a>
      </div>
    @endif

    @foreach ($crates as $crate)
      @if($crate->deleted != 1)
        @php
          $isInactive = $crate->status === 'inactive';
          $style = $isInactive ? 'opacity: 0.4; pointer-events: auto;' : '';
          $url = (Auth::check() && Auth::user()->user_role === 'seller')
              ? url('/crate/edit/' . $crate->id)
              : route('crates.show', $crate->id);
        @endphp

        <a href="{{ $url }}">
          <div class="crate-box" style="{{ $style }}">
            <img src="{{ asset('images/' . $crate->crate_image) }}" alt="{{ $crate->name }}">
            <div class="crate-label">{{ strtoupper($crate->name) }}</div>

            @if(Auth::check() && Auth::user()->user_role !== 'seller')
              @php
                $keyId = $crate->key_id;
                $keyCount = $userKeys[$keyId] ?? 0;
              @endphp

              @if($keyCount > 0)
                <div class="key-badge">
                  🔑 x{{ $keyCount }}
                </div>
              @endif
            @endif
          </div>
        </a>
      @endif
    @endforeach
  </div>
@endsection
