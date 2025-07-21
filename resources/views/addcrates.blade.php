@extends('base.base')

@section('title', 'Add Crate')

@section('content')
<a href="{{ url('/crates') }}" class="btn btn-warning mb-4" style="font-weight: bold; border-radius: 8px;">
  ← Back
</a>

<style>
  .navbar { display: none; }
  body {
    background-color: #2c2421;
    color: #fff;
    font-family: 'Segoe UI', sans-serif;
    padding: 40px;
  }
  .form-wrapper {
    background: linear-gradient(145deg, #3d3431, #2a2220);
    padding: 40px;
    border-radius: 20px;
    max-width: 1000px;
    margin: auto;
    box-shadow: 0 0 25px rgba(255, 215, 0, 0.4);
  }
  .form-title {
    text-align: center;
    color: #ffd700;
    font-size: 36px;
    margin-bottom: 30px;
    text-shadow: 1px 1px 2px #000;
  }
  .row-flex {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 20px;
  }
  .col-half {
    flex: 1 1 45%;
  }
  label {
    display: block;
    font-weight: bold;
    margin-top: 15px;
  }
  input[type="text"], input[type="number"], input[type="file"] {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border-radius: 10px;
    border: none;
    font-size: 16px;
  }
  .img-preview {
    display: block;
    max-width: 100%;
    max-height: 180px;
    margin-top: 10px;
    border-radius: 10px;
    object-fit: contain;
    background: #fff;
    padding: 6px;
  }
  .section-title {
    font-size: 20px;
    color: #ffecc4;
    margin-top: 40px;
    border-top: 1px dashed #ffd700;
    padding-top: 20px;
    text-align: center;
  }
  .item-row {
    display: flex;
    gap: 20px;
    align-items: center;
    margin-top: 20px;
    padding: 16px;
    border-radius: 12px;
    border: 2px solid #ffd70033;
    background: rgba(255, 255, 255, 0.05);
  }
  .item-image-col {
    flex: 0 0 120px;
  }
  .item-image-col img {
    width: 100%;
    border-radius: 8px;
    object-fit: contain;
    background: #fff;
    padding: 4px;
  }
  .item-info-col {
    flex: 1;
  }
  .item-info-col input {
    margin-bottom: 10px;
    font-size: 15px;
  }
  .btn-submit {
    background: linear-gradient(90deg, #ffd700, #ffb700);
    color: #1a1a1a;
    font-weight: bold;
    padding: 14px 30px;
    border: none;
    border-radius: 12px;
    margin-top: 30px;
    width: 100%;
    font-size: 18px;
    transition: all 0.3s ease;
    box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
  }
  .btn-submit:hover {
    background: linear-gradient(90deg, #ffe658, #ffc107);
    transform: scale(1.03);
    box-shadow: 0 0 25px rgba(255, 215, 0, 0.8);
  }
  .alert {
    margin-top: 20px;
    padding: 15px;
    background-color: #28a745;
    color: white;
    border-radius: 10px;
    text-align: center;
    display: none;
    font-weight: bold;
  }
  .rarity-Rare    { background-color: #c0c0c0; }
  .rarity-Elite   { background-color: #1e90ff; }
  .rarity-Epic    { background-color: #9932cc; }
  .rarity-Fate    { background-color: #ff8c00; }
  .rarity-Mythic  { background-color: #eeff00; }
  .total-rate {
    margin-top: 10px;
    font-weight: bold;
    color: #ffd700;
    text-align: right;
    font-size: 16px;
  }
</style>

<div class="form-wrapper">
  <div class="form-title">Add New Crate</div>

  @if (session('error'))
    <div style="background-color: #dc3545; color: white; font-weight: bold; padding: 12px; border-radius: 8px; margin-bottom: 15px;">
      {{ session('error') }}
    </div>
  @endif

  <form id="crateForm" action="{{ route('crates.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row-flex">
      <div class="col-half">
        <label>Upload Crate Image</label>
        <input type="file" name="crate_image" accept="image/*" onchange="previewImage(event, 'cratePreview')" required>
        <img id="cratePreview" class="img-preview" alt="Crate Preview">

        <label>Crate Name</label>
        <input type="text" name="crate_name" value="{{ old('crate_name') }}" required>
      </div>

      <div class="col-half">
        <label>Upload Key Image</label>
        <input type="file" name="key_image" accept="image/*" onchange="previewImage(event, 'keyPreview')" required>
        <img id="keyPreview" class="img-preview" alt="Key Preview">

        <label>Key Name</label>
        <input type="text" name="key_name" value="{{ old('key_name') }}" required>

        <label>Key Price (IDR)</label>
        <input type="text" name="key_price" value="{{ old('key_price') }}" oninput="validateNumberInput(this)" required>
      </div>
    </div>

    <div class="section-title">Add 5 Items</div>

    @php
      $rarities = ['Rare', 'Elite', 'Epic', 'Fate', 'Mythic'];
    @endphp

    @for ($i = 1; $i <= 5; $i++)
      <div class="item-row rarity-{{ $rarities[$i - 1] }}">
        <div class="item-image-col">
          <input type="file" name="item_image_{{ $i }}" accept="image/*" onchange="previewImage(event, 'itemPreview{{ $i }}')" required>
          <img id="itemPreview{{ $i }}" class="img-preview" alt="Item {{ $i }} Preview">
        </div>
        <div class="item-info-col">
          <input type="text" name="item_name_{{ $i }}" placeholder="Item {{ $i }} Name" value="{{ old('item_name_'.$i) }}" required>
          <input type="text" name="item_rate_{{ $i }}" placeholder="Rate (%)" value="{{ old('item_rate_'.$i) }}" oninput="validateNumberInput(this); updateTotalRate()" required>
        </div>
      </div>
    @endfor

    <div class="total-rate">Total Rate: <span id="totalRate">0</span>%</div>

    <button type="submit" class="btn-submit">Add Crate</button>
    <div class="alert" id="successAlert">✅ Crate successfully added!</div>
  </form>
</div>

<script>
  function previewImage(event, previewId) {
    const reader = new FileReader();
    reader.onload = () => document.getElementById(previewId).src = reader.result;
    reader.readAsDataURL(event.target.files[0]);
  }

  function validateNumberInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
  }

  function updateTotalRate() {
    let total = 0;
    for (let i = 1; i <= 5; i++) {
      const rateInput = document.querySelector(`[name="item_rate_${i}"]`);
      total += parseInt(rateInput.value) || 0;
    }
    document.getElementById('totalRate').innerText = total;
  }

  document.getElementById('crateForm').addEventListener('submit', function (e) {
    let total = 0;
    for (let i = 1; i <= 5; i++) {
      total += parseInt(document.querySelector(`[name="item_rate_${i}"]`).value) || 0;
    }
    if (total !== 100) {
      e.preventDefault();
      alert('❌ Total rate harus tepat 100%.');
    }
  });

  const allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];
  document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function (e) {
      const file = e.target.files[0];
      const maxSize = 3 * 1024 * 1024;
      if (file) {
        if (!allowedTypes.includes(file.type)) {
          alert('❌ File harus PNG, JPG, atau JPEG.');
          e.target.value = '';
          return;
        }
        if (file.size > maxSize) {
          alert('⚠️ File terlalu besar. Maksimal 3MB.');
          e.target.value = '';
          return;
        }
      }
    });
  });
</script>
@endsection
