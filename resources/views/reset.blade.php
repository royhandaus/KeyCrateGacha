<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password - KeyCrate</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #3D3431;
      font-family: sans-serif;
    }
    .reset-card {
      background-color: #fff8c9;
      border: 2px solid #3399ff;
      border-radius: 12px;
      padding: 30px;
      width: 100%;
      max-width: 400px;
      margin: 60px auto;
      text-align: center;
    }
    .btn-submit {
      background-color: black;
      color: white;
      border-radius: 8px;
    }
    .btn-submit:hover {
      background-color: #333;
    }
  </style>
</head>
<body>

<div class="reset-card shadow">
  <img src="{{ asset('Images/Keycrate_logo.png') }}" alt="KeyCrate Logo" class="rounded-circle mb-3" width="80">
  <h5 class="mb-3 text-dark">Set New Password</h5>

  <form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="password" name="new_password" class="form-control" placeholder="New password" required>
    <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm password" required>

    <button type="submit" class="btn btn-submit w-100 mt-2">Reset Password</button>
  </form>
</div>

</body>
</html>
