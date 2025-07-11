<form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST">
    @csrf
    @if(isset($category)) @method('PUT') @endif

    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="d-grid">
        <button class="btn btn-success">💾 Simpan</button>
    </div>
</form>
