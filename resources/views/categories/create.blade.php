@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">+ Tambah Kategori</h5>
        </div>
        <div class="card-body">
            @include('categories.form')
        </div>
    </div>
</div>
@endsection
