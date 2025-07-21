@extends('base.base')

@section('content')
<style>
    html, body {
      background-color: #2b2522;
      color: #f5f5f5;
      font-family: 'Segoe UI', sans-serif;
    }
</style>
<div class="container mt-5" style="max-width: 1000px;">
    <div class="p-4 rounded shadow" style="background-color: #2c2522;">
        <h4 class="mb-4 text-white"><i class="bi bi-box-seam me-2"></i> My Inventory</h4>

        @if(count($items) > 0)
        <div class="table-responsive">
            <table class="table table-dark table-hover rounded">
                <thead>
                    <tr>
                        <th scope="col">Key Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Acquired At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($item['acquired_at'])->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('crates') }}" class="btn btn-primary btn-sm">Open</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-white">You haven't acquired any keys yet. Visit the <a href="/store">shop</a> to get started!</p>
        @endif
    </div>
</div>
@endsection
