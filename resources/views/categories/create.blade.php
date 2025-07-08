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
    <h2>{{ isset($category) ? 'Edit' : 'Tambah' }} Kategori</h2>
    <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST">
        @csrf
        @if(isset($category)) @method('PUT') @endif

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
@endsection

</body>
</html>