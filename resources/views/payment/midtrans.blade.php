@extends('base.base')

@section('content')
<div class="container mt-5">
    <h3 class="text-white">Redirecting to payment...</h3>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    snap.pay("{{ $snapToken }}", {
        onSuccess: function(result) {
            fetch("{{ route('payment.success') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    gross_amount: result.gross_amount,
                    transaction_id: result.transaction_id,
                    order_id: result.order_id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "{{ route('inventory') }}";
                }
            });
        },
        onPending: function(result) {
            window.location.href = "{{ route('cart') }}";
        },
        onError: function(result) {
            alert("Terjadi error saat pembayaran.");
            window.location.href = "{{ route('cart') }}";
            console.log(result);
        },
        onClose: function() {
            alert("Transaksi dibatalkan. Item tetap di cart.");
            window.location.href = "{{ route('cart') }}";
        }
    });
</script>


@endsection


