@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">🧾 Daftar Transaksi</h5>
            <a href="{{ route('orders.create') }}" class="btn btn-light btn-sm">+ Buat Transaksi</a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">Detail</a>
                                <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">Belum ada transaksi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
