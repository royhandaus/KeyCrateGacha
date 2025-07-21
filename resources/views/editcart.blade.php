@extends('base.base')
@section('content')
  <style>
    html {
      background-color: #2b2522;
    }

    body {
      background-color: #2b2522;
      color: #f5f5f5;
      font-family: 'Segoe UI', sans-serif;
    }

    .form-container {
      max-width: 500px;
      margin: 50px auto;
      background-color: #0f0f1d;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 0 16px rgba(0, 0, 0, 0.5);
    }

    h2 {
      color: #ffd700;
      font-weight: bold;
      margin-bottom: 25px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ffd700;
      background-color: #1a1a1a;
      color: #fff;
      margin-bottom: 20px;
    }

    .btn-group {
      display: flex;
      justify-content: space-between;
    }

    .btn-update {
      background-color: #48c78e;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    .btn-cancel {
      background-color: transparent;
      border: 1px solid #dc3545;
      color: #dc3545;
      padding: 10px 20px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    .btn-cancel:hover {
      background-color: #dc3545;
      color: white;
    }
  </style>

  <div class="form-container">
    <h2>Edit Product</h2>
    <form>
      <label for="product_name">Product Name</label>
      <input type="text" id="product_name" value="Nebula Vault Key" disabled>

      <label for="rarity">Rarity</label>
      <input type="text" id="rarity" value="rare" disabled>

      <label for="quantity">Quantity</label>
      <input type="number" id="quantity" value="1">

      <label for="total">Total (IDR)</label>
      <input type="text" id="total" value="150000">

      <div class="btn-group">
        <a href="cart" class="btn-update">Update</a>
        <button type="button" class="btn-cancel" onclick="window.history.back();">Cancel</button>
      </div>
    </form>
  </div>
@endsection
