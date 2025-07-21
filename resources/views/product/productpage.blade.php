@extends('base.base')

@section('content')

<div class="container mt-5" style="max-width: 1100px;">
    <form action="{{ route('product.update_stok') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="p-4 rounded shadow" style="background-color: #241f1d;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-white mb-0">
                    <i class="bi bi-box-seam me-2"></i> Crate Product Management
                </h4>
                <button type="submit" class="btn btn-success px-4 py-2 fw-bold shadow-sm">
                    <i class="bi bi-save me-1"></i> Save
                </button>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-dark table-hover align-middle table-bordered shadow-sm rounded">
                <thead class="table-secondary text-dark text-center">
                    <tr>
                        <th style="width: 200px;">Crate Name</th>
                        <th>Item Name</th>
                        <th style="width: 120px;">Stock</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($crates as $crate)
                        @for ($i = 1; $i <= 5; $i++)
                            @php
                                $stok = $crate->{'item'.$i.'_stok'};
                                $isEmpty = $stok <= 0;
                            @endphp
                            <tr class="{{ $isEmpty ? 'table-danger' : '' }}">
                                @if ($i === 1)
                                    <td rowspan="5" class="text-center align-middle">
                                        <span class="badge bg-primary text-wrap fs-6">{{ $crate->name }}.png</span>
                                        <div class="mt-2">
                                            <img src="{{ asset('images/' . $crate->crate_image) }}" width="80" class="rounded shadow">
                                        </div>
                                    </td>
                                @endif
                                <td class="text-white">{{ $crate->{'item'.$i.'_name'} }}</td>
                                <td>
                                    <input type="number" name="stok[{{ $crate->id }}][item{{ $i }}]" 
                                        value="{{ $stok }}" 
                                        min="0" 
                                        class="form-control form-control-sm text-center {{ $isEmpty ? 'bg-danger text-white fw-bold' : 'bg-dark text-white' }}"
                                        style="width: 80px;">
                                </td>
                                <td>
                                    <img src="{{ asset('images/' . $crate->{'item'.$i.'_image'}) }}" 
                                        width="60" 
                                        class="rounded shadow-sm border border-secondary">
                                </td>
                            </tr>
                        @endfor
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No crates found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </form>
</div>

@endsection
