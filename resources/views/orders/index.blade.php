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
    <h2>Daftar Pesanan</h2>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">+ Buat Pesanan Baru</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th><th>Total</th><th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>Rp{{ number_format($order->total_price) }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

</body>
</html>