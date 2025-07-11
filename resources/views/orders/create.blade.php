@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">📝 Buat Transaksi</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="customer_name" class="form-control" required>
                </div>

                <h6 class="mt-4 mb-2">Produk:</h6>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" name="products[{{ $product->id }}][selected]">
                                        {{ $product->name }} (Rp{{ number_format($product->price) }})
                                    </label>
                                </td>
                                <td style="width: 120px;">
                                    <input type="number" name="products[{{ $product->id }}][quantity]" class="form-control form-control-sm" value="1" min="1">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button class="btn btn-success">💾 Simpan Transaksi</button>
            </form>
        </div>
    </div>
</div>
@endsection
