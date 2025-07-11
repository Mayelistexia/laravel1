@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($product)) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" 
                           value="{{ old('name', $product->name ?? '') }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="price" class="form-control" 
                           value="{{ old('price', $product->price ?? '') }}" required>
                    @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" 
                                {{ old('category_id', $product->category_id ?? '') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar (opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if(isset($product) && $product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail mt-2" width="120">
                    @endif
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">💾 Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
