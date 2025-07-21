@extends('base.base')

@section('content')
<div class="container mt-5 text-center text-white">
    <h2>🎉 Pembayaran Berhasil!</h2>
    <p>Terima kasih telah melakukan pembelian.</p>
    <a href="{{ route('store') }}" class="btn btn-success">Kembali ke Toko</a>
</div>
@endsection
