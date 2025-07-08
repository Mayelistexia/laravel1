@extends('layouts.app')

@section('content')
    <h2>Buat Pesanan Baru</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Produk</label>
            <select name="product_id" class="form-control">
                @foreach($products as $p)
                    <option value="{{ $p->id }}">{{ $p->name }} - Rp{{ number_format($p->price) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="quantity" class="form-control" value="1" min="1">
        </div>

        <button class="btn btn-success">Simpan Pesanan</button>
    </form>
@endsection