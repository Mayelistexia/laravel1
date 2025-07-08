<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

@section('content')
    <h2>Detail Pesanan #{{ $order->id }}</h2>
    <p><strong>Total:</strong> Rp{{ number_format($order->total_price) }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>

    <h4>Item Pesanan:</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>Rp{{ number_format($item->price) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp{{ number_format($item->price * $item->quantity) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

</body>
</html>