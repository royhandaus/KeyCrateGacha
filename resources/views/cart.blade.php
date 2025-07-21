@extends('base.base')

@section('title', 'Shopping Cart')

@section('content')
<div class="container my-4">
    <h2 class="mb-4 text-white">Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($cartItems) > 0)
    <form action="{{ route('cart.checkout') }}" method="POST" id="checkoutForm">
        @csrf

        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th style="width: 40px;">
                        <input type="checkbox" id="selectAll" checked>
                    </th>
                    <th>Name</th>
                    <th style="width: 90px;">Quantity</th>
                    <th>Price per unit</th>
                    <th>Total</th>
                    <th style="width: 110px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>
                        <input type="checkbox" name="selected_items[]" value="{{ $item['key_id'] }}" class="itemCheckbox" checked>
                    </td>
                    <td>{{ $item['name'] }}</td>
                    <td>
                        <input
                            type="number"
                            class="form-control form-control-sm quantity-input"
                            data-keyid="{{ $item['key_id'] }}"
                            value="{{ $item['quantity'] }}"
                            min="1"
                            style="width: 70px; text-align: center; border-radius: 6px;"
                        >
                    </td>
                    <td class="price-per-unit" data-keyid="{{ $item['key_id'] }}">
                        IDR {{ number_format($item['harga_satuan'], 0, ',', '.') }}
                    </td>
                    <td class="item-total" data-keyid="{{ $item['key_id'] }}">
                        IDR {{ number_format($item['total'], 0, ',', '.') }}
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm btn-remove" data-keyid="{{ $item['key_id'] }}">
                            Remove
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end text-white fs-5 mt-3">
            Total: <span id="grandTotalDisplay">IDR {{ number_format($cartTotal, 0, ',', '.') }}</span>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Checkout Selected Items</button>
    </form>

    @else
        <p class="text-white">Cart kamu kosong.</p>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function formatRupiah(angka) {
        return 'IDR ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateGrandTotal() {
        let grandTotal = 0;
        $('.item-total').each(function() {
            let totalText = $(this).text().replace(/[^\d]/g, '');
            grandTotal += parseInt(totalText) || 0;
        });
        $('#grandTotalDisplay').text(formatRupiah(grandTotal));
    }

    $('.quantity-input').on('change blur', function() {
        let input = $(this);
        let keyId = input.data('keyid');
        let newQty = parseInt(input.val());

        if (isNaN(newQty) || newQty < 1) {
            alert('Quantity minimal 1');
            input.val(1);
            newQty = 1;
        }

        $.ajax({
            url: '/cart/update/' + keyId,
            type: 'POST',
            data: {
                quantity: newQty,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                let priceText = input.closest('tr').find('.price-per-unit').text().replace(/[^\d]/g, '');
                let price = parseInt(priceText) || 0;
                let newTotal = price * newQty;
                input.closest('tr').find('.item-total').text(formatRupiah(newTotal));
                updateGrandTotal();
            },
            error: function(xhr) {
                alert('Gagal update quantity');
                console.error(xhr);
            }
        });
    });

    $('#selectAll').on('change', function() {
        let checked = this.checked;
        $('.itemCheckbox').prop('checked', checked);
    });

    $('.btn-remove').click(function() {
        if (!confirm('Hapus item ini?')) return;

        let keyId = $(this).data('keyid');
        let button = $(this);

        $.ajax({
            url: '/cart/remove/' + keyId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                button.closest('tr').remove();
                updateGrandTotal();

                if ($('tbody tr').length === 0) {
                    $('#checkoutForm').replaceWith('<p class="text-white">Cart kamu kosong.</p>');
                }
            },
            error: function(xhr) {
                alert('Gagal menghapus item');
            }
        });
    });
});
</script>
@endsection
