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
    <h2>Produk</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>
    <table class="table">
        <thead>
            <tr>
                <th>Gambar</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td>
                        @if($p->image)
                            <img src="{{ asset('storage/'.$p->image) }}" width="60">
                        @endif
                    </td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->category->name }}</td>
                    <td>Rp{{ number_format($p->price) }}</td>
                    <td>
                        <a href="{{ route('products.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline-block">@csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

</body>
</html>