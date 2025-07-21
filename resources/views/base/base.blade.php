<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'My Store')</title>

  {{-- Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  {{-- Custom Style --}}
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      background-color: #2b2522;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
    }

    .gold-text, .gold-text i {
      color: #FFD700 !important;
    }

    .navbar, .footer {
      background-color: #3D3431;
    }

    .footer {
      color: #FFD700;
      text-align: center;
      padding: 1rem;
    }

    .footer a, .footer i, .footer p {
      color: #FFD700 !important;
      text-decoration: none;
    }

    /* ✅ Tambahan responsive header */
    .navbar .container {
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }

    .navbar-collapse {
        flex-basis: 100%;
        margin-top: 10px;
    }

    .navbar-toggler {
        margin-left: auto;
    }

    .navbar-nav {
        gap: 8px;
    }

    /* Fix logo profil di mobile */
    @media (max-width: 992px) {
        .navbar .dropdown > a {
            padding: 0 !important;
            margin-left: auto;
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .navbar .dropdown i.fas.fa-user-circle {
            font-size: 2.5rem !important;
        }

        .dropdown-menu {
            margin-top: 10px !important;
            right: 0;
            left: auto;
        }
    }

  </style>
</head>


<body>

  {{-- Header --}}
  @unless (View::hasSection('noheader'))
    @include('include.header')
  @endunless

  {{-- Main Content --}}
  <main>
    <div class="container-fluid px-0">
      @yield('content')
    </div>
  </main>

  {{-- Footer --}}
  @unless (View::hasSection('nofooter'))
    @include('include.footer')
  @endunless

</body>

</html>
