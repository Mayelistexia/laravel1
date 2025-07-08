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
    <h2>{{ isset($product) ? 'Edit' : 'Tambah' }} Produk</h2>
    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" class="form-control" required>
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ (old('category_id', $product->category_id ?? '') == $c->id) ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gambar (opsional)</label>
            <input type="file" name="image" class="form-control">
            @if(isset($product) && $product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="80" class="mt-2">
            @endif
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
@endsection

</body>
</html>