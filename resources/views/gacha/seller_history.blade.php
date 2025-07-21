@extends('base.base')

@section('content')
<div class="container mt-5">
    <h3 class="text-white">📦 Crate Gacha History (Seller View)</h3>
    <table class="table table-dark mt-3">
        <thead>
            <tr>
                <th>User</th>
                <th>Crate</th>
                <th>Item</th>
                <th>Image</th>
                <th>Rate</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td>{{ $history->user_name }}</td>
                    <td>{{ $history->crate_name }}</td>
                    <td>{{ $history->item_name }}</td>
                    <td><img src="{{ asset('images/' . $history->item_image) }}" width="60"></td>
                    <td>{{ $history->rate }}%</td>
                    <td>{{ \Carbon\Carbon::parse($history->created_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
