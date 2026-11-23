<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Gaming Store')</title>

    <link rel="stylesheet"
          href="{{ asset('css/store.css') }}">

    @stack('styles')
</head>
<body>

<header class="site-header">
    <div class="nav-container">

        <a href="{{ route('products.index') }}"
           class="brand">
            Game<span>Tech</span>
        </a>

        <nav class="nav-links">
            <a href="{{ route('products.index') }}">
                Products
            </a>

            @auth
                <a href="{{ route('cart.index') }}">
                    My Cart
                </a>

                <a href="{{ route('orders.index') }}">
                    My Orders
                </a>

                @can('manage-products')
                    <a href="{{ route('admin.products.index') }}">
                        Admin Dashboard
                    </a>
                @endcan

                <span>
                    {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}"
                      method="POST">
                    @csrf

                    <button type="submit"
                            class="btn btn-secondary">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="btn">
                    Register
                </a>
            @endauth
        </nav>
    </div>
</header>

<main class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @yield('content')

</main>

<footer class="site-footer">
    &copy; {{ date('Y') }} GameTech.
    Gaming accessories and electronics.
</footer>

</body>
</html>
