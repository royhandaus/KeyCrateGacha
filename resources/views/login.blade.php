<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>KeyCrate Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #3D3431;
    }
    .login-card {
      background-color: #fff8c9;
      border: 2px solid #3399ff;
      border-radius: 10px;
      padding: 30px;
      width: 100%;
      max-width: 350px;
      margin: 50px auto;
      text-align: center;
    }
    .login-card img {
      width: 100px;
      margin-bottom: 20px;
    }
    .form-control {
      margin-bottom: 15px;
    }
    .btn-login {
      background-color: black;
      color: white;
      border-radius: 8px;
    }
    .btn-login:hover {
      background-color: #333;
    }
    .btn-guest {
      margin-top: 10px;
      background-color: #555;
      color: white;
      border-radius: 8px;
      width: 100%;
    }
    .btn-guest:hover {
      background-color: #444;
    }
    .eye-icon {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #333;
    }
  </style>
</head>
<body>

@if (session('success'))
    <div class="alert alert-success" id="alert-message" style="max-width:350px; margin: 0 auto 20px;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="login-card shadow">
  <img src="{{ asset('images/Keycrate_logo.png') }}" alt="KeyCrate Logo" class="rounded-circle">

  {{-- Tampilkan error login di atas form --}}
  @if ($errors->has('login'))
    <div class="alert alert-danger text-center">
      {{ $errors->first('login') }}
    </div>
  @endif

  <form method="POST" action="{{ route('login.custom') }}">
    @csrf
    <div class="text-start mb-1">Username :</div>
    <input type="text" name="username" class="form-control" placeholder="Enter username" required>

    <div class="text-start mb-1">Password :</div>
    <div class="position-relative">
      <input type="password" name="password" id="password" class="form-control mb-1" placeholder="Enter password" required>
      <i class="bi bi-eye eye-icon" onclick="togglePassword(this)"></i>
    </div>

    <div class="text-end mb-4">
      <a href="{{ url('forget') }}" class="text-primary text-decoration-none small">Forget your password?</a>
    </div>

    <button type="submit" class="btn btn-login w-100 mt-3">Login</button>
  </form>

  <!-- Tombol Login as Guest -->
  {{-- <form method="POST" action="{{ route('login.guest') }}">
    @csrf
    
  </form> --}}

<a href="home" class="btn btn-guest">Login as Guest</a>

  <small class="mt-2 d-block">
    don't have account? <a href="{{ route('register.form') }}" class="text-primary">click here to register</a>
  </small>
</div>

<script>
  function togglePassword(el) {
    const input = document.getElementById('password');
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    el.classList.toggle('bi-eye');
    el.classList.toggle('bi-eye-slash');
  }

  setTimeout(() => {
    const alert = document.getElementById('alert-message');
    if (alert) {
      alert.style.display = 'none';
    }
  }, 4000);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
