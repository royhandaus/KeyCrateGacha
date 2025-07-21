@extends('base.base')
@section('content')
  <style>
      html {
        background-color: #2b2522;
      }
    body {
      background-color: #2b2522; /* Solid dark background */
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

    .logo {
      margin-bottom: 30px;
      filter: drop-shadow(0 0 8px rgba(255,255,255,0.3));
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
      background: linear-gradient(to bottom, #1f1b18, #2b2522);
      border: 2px solid rgba(255, 255, 255, 0.08);
      border-radius: 14px;
      padding: 20px;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
    }

    .crate-box:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 0 28px rgba(255, 204, 0, 0.4);
      border-color: #ffd700;
    }

    .crate-box img {
      width: 100%;
      height: auto;
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
</head>
<body>
  <h1>Select a Crate to Open</h1>
  <div class="crate-grid">
    @php
      $crates = [
        'celestic' => 'Celestic.png',
        'dust' => 'Dust.png',
        'eclipse' => 'Eclipse.png',
        'ironfang' => 'Ironfang.png',
        'nebula' => 'Nebula.png',
        'oracle' => 'Oracle.png'
      ];
    @endphp

    @foreach ($crates as $key => $image)
      <a href="{{ url('/gacha/' . $key) }}">
        <div class="crate-box">
          <img src="{{ asset('images/' . $image) }}" alt="{{ ucfirst($key) }}">
          <div class="crate-label">{{ strtoupper($key) }} CRATE</div>
        </div>
      </a>
    @endforeach
    <div class="crate-box d-flex flex-column justify-content-center align-items-center" style="border: 2px dashed #ffd700;">
      <a href="{{ url('/crate/add') }}" class="text-decoration-none text-warning">
        <i class="fas fa-plus-circle fa-3x mb-2"></i>
        <div class="crate-label">Add New Crate</div>
      </a>
    </div>
  </div>
</body>
</html>
@endsection