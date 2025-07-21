@extends('base.base')

@section('content')
<div class="container mt-5" style="max-width: 800px;">
    <div class="p-4 rounded shadow" style="background-color: #2c2522;">
        <h4 class="mb-4 text-white">
            <i class="bi bi-receipt me-2"></i> Order Details
        </h4>
        <table class="table table-dark table-bordered">
            <tr><th>Order ID</th><td>{{ $order['id'] }}</td></tr>
            <tr><th>Date</th><td>{{ \Carbon\Carbon::parse($order['date'])->format('d M Y H:i') }}</td></tr>
            <tr><th>Box Name</th><td>{{ $order['box_name'] }}</td></tr>
            <tr><th>Rarity</th><td>{{ $order['rarity'] }}</td></tr>
            <tr><th>Quantity</th><td>{{ $order['quantity'] }}</td></tr>
            <tr><th>Total</th><td>IDR {{ number_format($order['total'], 0, ',', '.') }}</td></tr>
            <tr><th>Reward</th><td>{{ $order['reward'] }}</td></tr>
        </table>
        <a href="{{ route('history') }}" class="btn btn-secondary mt-3">← Back to History</a>
    </div>
</div>
@endsection