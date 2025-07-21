@extends('base.base')

@section('content')
<div class="container mt-5" style="max-width: 1000px;">
    <div class="p-4 rounded shadow" style="background-color: #2c2522;">
        <h4 class="mb-4 text-white"><i class="bi bi-receipt me-2"></i> Purchase History</h4>

        @if($invoices->count() > 0)
            @foreach($invoices as $invoice)
                <div class="mb-4 p-3 rounded" style="background-color: #1e1e2e;">
    <h5 class="text-warning">
        Invoice: {{ $invoice->kode_invoice }}
        <span class="text-white float-end">{{ $invoice->created_at->format('d M Y') }}</span>
    </h5>

    <div class="table-responsive">
        <table class="table table-dark table-sm mt-2 mb-0">
            <thead>
                <tr>
                    <th>Key Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                    <tr>
                        <td>{{ $item->key->nama_key ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ "Rp". number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td>{{ "Rp". number_format($item->total_price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                    <td>Rp{{ number_format($invoice->total_price, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

            @endforeach
        @else
            <p class="text-white">You haven’t purchased anything yet.</p>
        @endif
    </div>
</div>
@endsection
