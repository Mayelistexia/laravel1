@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <h5 class="mb-0">✏️ Edit Kategori</h5>
        </div>
        <div class="card-body">
            @include('categories.form', ['category' => $category])
        </div>
    </div>
</div>
@endsection
