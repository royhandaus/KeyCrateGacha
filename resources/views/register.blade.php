<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    rel="stylesheet"
  />
  <title>Register</title>
  <style>
    body {
      background-color: #3d3431;
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
    .btn-back {
      margin-top: 12px;
      background-color: #f0ad4e;
      border-radius: 8px;
      color: black;
      width: 100%;
      text-decoration: none;
      display: inline-block;
      padding: 8px 0;
    }
    .btn-back:hover {
      background-color: #ec971f;
      color: white;
      text-decoration: none;
    }
    .eye-icon {
      position: absolute;
      right: 20px;
      top: 8px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="login-card shadow">
    <img
      src="images/Keycrate_logo.png"
      alt="KeyCrate Logo"
      class="rounded-circle"
      width="100"
    />

    {{-- Feedback Sukses & Error --}}
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
      @csrf
      <input
        type="text"
        name="nama_user"
        class="form-control"
        placeholder="Enter name"
        value="{{ old('nama_user') }}"
        required
      />
      <input
        type="text"
        name="user_username"
        class="form-control"
        placeholder="Enter username"
        value="{{ old('user_username') }}"
        required
      />
      <div class="position-relative mb-3">
        <input
          type="password"
          name="user_password"
          id="password"
          class="form-control"
          placeholder="Enter password"
          required
        />
        <i
          class="bi bi-eye-slash eye-icon"
          style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
          onclick="togglePasswordVisibility('password', this)"
        ></i>
      </div>

      <div class="position-relative mb-3">
        <input
          type="password"
          name="user_password_confirmation"
          id="user_password_confirmation"
          class="form-control"
          placeholder="Confirm password"
          required
        />
        <i
          class="bi bi-eye-slash eye-icon"
          style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
          onclick="togglePasswordVisibility('user_password_confirmation', this)"
        ></i>
      </div>

      <input
        type="email"
        name="user_email"
        class="form-control"
        placeholder="Enter email"
        value="{{ old('user_email') }}"
        required
      />
      <input
        type="text"
        name="no_telp"
        class="form-control"
        placeholder="Enter phone number"
        maxlength="12"
        value="{{ old('no_telp') }}"
        required
      />
      <!-- Tambahkan ini sebelum tombol submit -->
      <select name="role" class="form-control mb-3" required>
        <option value="" disabled selected>Pilih Role</option>
        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
        <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Seller</option>
      </select>
      <button type="submit" class="btn btn-login w-100 mt-3">Register</button>
    </form>

    <a href="{{ route('login') }}" class="btn-back">Back to Login</a>
  </div>

  <script>
    function togglePasswordVisibility(inputId, iconElement) {
      const input = document.getElementById(inputId);
      if (input.type === 'password') {
        input.type = 'text';
        iconElement.classList.remove('bi-eye-slash');
        iconElement.classList.add('bi-eye');
      } else {
        input.type = 'password';
        iconElement.classList.remove('bi-eye');
        iconElement.classList.add('bi-eye-slash');
      }
    }
  </script>
</body>
</html>
