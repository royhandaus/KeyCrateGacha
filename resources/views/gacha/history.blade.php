@extends('base.base')

@section('content')
<style>
    .history-container {
        background: #1e1e2f;
        border-radius: 12px;
        padding: 30px;
        color: #fff;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
    }

    .history-container h3 {
        color: gold;
        font-weight: bold;
        text-shadow: 0 0 8px rgba(255, 215, 0, 0.4);
    }

    .table-dark th {
        background-color: #2c2c3a;
        color: #ffdd57;
        border-bottom: 2px solid gold;
    }

    .table-dark td {
        background-color: #252535;
        color: #e0e0e0;
        vertical-align: middle;
    }

    .table-dark tr:hover td {
        background-color: #32324a;
    }

    .table-dark img {
        border-radius: 8px;
        border: 2px solid #ffdd57;
        box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
    }

    .no-history {
        text-align: center;
        color: #bbb;
        padding: 30px;
        font-size: 18px;
        font-style: italic;
    }
</style>

<div class="container mt-5">
    <div class="history-container">
        <h3 class="mb-4">🎲 Gacha History</h3>
        @if(count($histories) > 0)
        <div class="table-responsive">
            <table class="table table-dark table-hover rounded">
                <thead>
                    <tr>
                        <th>Crate</th>
                        <th>Item</th>
                        <th>Image</th>
                        <th>Rate</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                        <tr>
                            <td>{{ $history->crate->name }}</td>
                            <td>{{ $history->item_name }}</td>
                            <td>
                                <img src="{{ asset('images/' . $history->item_image) }}" width="60" height="60" alt="{{ $history->item_name }}">
                            </td>
                            <td>{{ $history->rate }}%</td>
                            <td>{{ $history->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <td>{{ $history->crate->name ?? 'Crate Tidak Ditemukan' }}</td>
        @endif
    </div>
</div>
@endsection
