<!DOCTYPE html>
<html>
<head>
    <title>Toko Elektronik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="/">Toko Elektronik</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Kategori</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Produk</a></li>
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item"><a class="nav-link">{{ auth()->user()->name }}</a></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">@csrf
                            <button class="btn btn-sm btn-outline-light" type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
