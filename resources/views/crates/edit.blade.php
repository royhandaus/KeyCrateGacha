@extends('base.base')

@section('title', 'Edit Crate')

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
  input[type="text"], input[type="number"], input[type="file"], select {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border-radius: 10px;
    border: none;
    font-size: 16px;
  }
  .img-preview {
    display: block;
    width: 100%;
    height: 160px;
    object-fit: contain;
    margin-top: 10px;
    border-radius: 10px;
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
  .item-info-col {
    flex: 1;
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
  <div class="form-title">Edit Crate</div>

  <form action="{{ url('/crate/update/' . $crate->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row-flex">
      <div class="col-half">
        <label>Crate Image</label>
        <input type="file" name="crate_image" accept="image/*">
        <img class="img-preview" src="{{ asset('images/' . $crate->crate_image) }}">

        <label>Crate Name</label>
        <input type="text" name="crate_name" value="{{ $crate->name }}" required>

        <label>Status</label>
        <select name="status" required>
          <option value="active" {{ $crate->status === 'active' ? 'selected' : '' }}>Active</option>
          <option value="inactive" {{ $crate->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @if($crate->status === 'active')
          <p style="color: #28f17f; font-weight: bold;">Status: Aktif</p>
        @else
          <p style="color: #ff5c5c; font-weight: bold;">Status: Tidak Aktif</p>
        @endif
      </div>

      <div class="col-half">
        <label>Key Image</label>
        <input type="file" name="key_image" accept="image/*">
        @if($crate->key)
          <img class="img-preview" src="{{ asset('images/' . $crate->key->image_key) }}">
        @endif
        
        <label>Key Name</label>
        <input type="text" name="key_name" value="{{ $crate->key->nama_key ?? '' }}" required>

        <label>Key Price (IDR)</label>
        <input type="text" name="key_price" value="{{ $crate->key->harga_key ?? '' }}" required>
      </div>
    </div>

    <div class="section-title">Edit Items</div>

    @php
      $rarities = ['Rare', 'Elite', 'Epic', 'Fate', 'Mythic'];
    @endphp

    @for ($i = 1; $i <= 5; $i++)
      <div class="item-row rarity-{{ $rarities[$i - 1] }}">
        <div class="item-image-col">
          <input type="file" name="item_image_{{ $i }}" accept="image/*">
          <img class="img-preview" src="{{ asset('images/' . $crate->{'item'.$i.'_image'} ) }}">
        </div>
        <div class="item-info-col">
          <input type="text" name="item_name_{{ $i }}" value="{{ $crate->{'item'.$i.'_name'} }}" required>
          <input type="text" name="item_rate_{{ $i }}" value="{{ $crate->{'item'.$i.'_rate'} }}" oninput="updateTotalRate()" required>
        </div>
      </div>
    @endfor

    <div class="total-rate">Total Rate: <span id="totalRate">0</span>%</div>

    <button type="submit" class="btn-submit">Update Crate</button>
  </form>

  <form action="{{ url('/crate/delete/' . $crate->id) }}" method="POST" style="margin-top: 20px;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger w-100">Delete Crate</button>
  </form>
</div>

<script>
  function updateTotalRate() {
    let total = 0;
    for (let i = 1; i <= 5; i++) {
      const rateInput = document.querySelector(`[name="item_rate_${i}"]`);
      total += parseInt(rateInput.value) || 0;
    }
    document.getElementById('totalRate').innerText = total;
  }

  document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
          const preview = e.target.nextElementSibling;
          if (preview && preview.tagName === 'IMG') {
            preview.src = ev.target.result;
          }
        };
        reader.readAsDataURL(file);
      }
    });
  });

  document.querySelector('form[action*="update"]').addEventListener('submit', function (e) {
    let total = 0;
    for (let i = 1; i <= 5; i++) {
      total += parseInt(document.querySelector(`[name="item_rate_${i}"]`).value) || 0;
    }
    if (total !== 100) {
      e.preventDefault();
      alert('❌ Total rate harus tepat 100%.');
    }
  });

  window.addEventListener('DOMContentLoaded', updateTotalRate);
</script>
@endsection
