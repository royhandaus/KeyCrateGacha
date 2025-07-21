@extends('base.base')

@section('title', 'Sales Report')

@section('content')
<div class="container mt-5" style="max-width: 1000px;">
    <div class="p-4 rounded shadow" style="background-color: #2c2522;">
        <h4 class="mb-4 text-white">
            <i class="bi bi-clipboard-data me-2"></i> Sales Report
        </h4>

        @if($penjualan->count() > 0)
            @php
                $grouped = $penjualan->groupBy('kode_invoice');
            @endphp

            @foreach($grouped as $kode => $items)
                <div class="mb-4 p-3 rounded" style="background-color: #1e1e2e;">
                    <h5 class="text-warning">
                        Invoice: {{ $kode }}
                        <span class="text-white float-end">{{ \Carbon\Carbon::parse($items[0]->tanggal_invoice)->format('d M Y') }}</span>
                    </h5>
                    <p class="text-light mb-2">Customer: <strong>{{ $items[0]->nama_user }}</strong></p>
                    <table class="table table-dark table-sm mt-2">
                        <thead>
                            <tr>
                                <th>Key Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach($items as $item)
                                @php $grandTotal += $item->total_price; @endphp
                                <tr>
                                    <td>{{ $item->nama_key }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ 'Rp'.number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td>{{ 'Rp'.number_format($item->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                                <td>Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endforeach
        @else
            <p class="text-white">Belum ada penjualan.</p>
        @endif
    </div>
</div>
@endsection
