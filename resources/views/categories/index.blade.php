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
    <h2>Kategori</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>
    <table class="table">
        <thead>
            <tr><th>Nama</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($categories as $c)
                <tr>
                    <td>{{ $c->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $c->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('categories.destroy', $c->id) }}" method="POST" style="display:inline-block">@csrf @method('DELETE')
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