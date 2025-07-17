@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Transaksi Baru</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_name" class="form-label">Nama Pelanggan</label>
            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" >
        </div>

        <h5>Pilih Produk</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <input type="checkbox" name="products[{{ $product->id }}][selected]" value="1">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>Rp{{ number_format($product->price) }}</td>
                    <td>
                        <input type="number" name="products[{{ $product->id }}][quantity]" value="1" min="1" class="form-control" style="width: 80px;">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Simpan Transaksi</button>
    </form>
</div>
@endsection
