<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>OTP Verification - KeyCrate</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #3D3431;
      font-family: sans-serif;
    }
    .otp-card {
      background-color: #fff8c9;
      border: 2px solid #3399ff;
      border-radius: 12px;
      padding: 30px;
      width: 100%;
      max-width: 400px;
      margin: 60px auto;
      text-align: center;
    }
    .form-control {
      margin-bottom: 15px;
    }
    .btn-send-otp, .btn-submit {
      background-color: black;
      color: white;
      border-radius: 8px;
    }
    .btn-send-otp:disabled {
      background-color: #666;
      cursor: not-allowed;
    }
    .btn-send-otp:hover:not(:disabled), .btn-submit:hover {
      background-color: #333;
    }
  </style>
</head>
<body>

<div class="otp-card shadow">
  <img src="{{ asset('Images/Keycrate_logo.png') }}" alt="KeyCrate Logo" class="rounded-circle mb-3" width="80">

  <h5 class="mb-3 text-dark">OTP Verification</h5>

  @if(session('success'))
    <div class="alert alert-info">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('otp.verify') }}">
    @csrf

    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>

    <div class="d-flex mb-3">
      <input type="text" name="otp_code" class="form-control me-2" placeholder="Enter OTP" required>
      <button type="button" class="btn btn-send-otp" id="sendOtpBtn" onclick="startCooldown()" disabled>Kirim OTP</button>
    </div>

    <button type="submit" class="btn btn-submit w-100">Submit</button>
  </form>

  <small class="d-block mt-3">
    <a href="/login" class="text-primary">← Back to Login</a>
  </small>
</div>

<script>
  const emailInput = document.getElementById('email');
  const sendOtpBtn = document.getElementById('sendOtpBtn');

  emailInput.addEventListener('input', () => {
    sendOtpBtn.disabled = !emailInput.value.trim();
  });

  function startCooldown() {
    const cooldown = 60;
    let timeLeft = cooldown;

    sendOtpBtn.disabled = true;
    const originalText = sendOtpBtn.innerText;
    sendOtpBtn.innerText = `Tunggu ${timeLeft}s`;

    const interval = setInterval(() => {
      timeLeft--;
      sendOtpBtn.innerText = `Tunggu ${timeLeft}s`;
      if (timeLeft <= 0) {
        clearInterval(interval);
        sendOtpBtn.disabled = !emailInput.value.trim();
        sendOtpBtn.innerText = originalText;
      }
    }, 1000);

    const email = emailInput.value.trim();
    if (email) {
      fetch(`/send-otp?email=${encodeURIComponent(email)}`)
        .then(res => {
          if (!res.ok) throw new Error("Email belum terdaftar.");
          return res.json();
        })
        .then(data => {
          alert(data.message); // sukses
          console.log('OTP sent:', data);
        })
        .catch(err => {
          alert(err.message); // gagal
          console.error('Error sending OTP:', err);
        });
    }
  }
</script>


</body>
</html>
