<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cuadito') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ App::environment('local') ? asset('images/logo/logo.png') : secure_asset('images/logo/favicon.ico') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('images/logo/ycc_logo.webp')}}" height="50">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <form method="GET" action="/search" class="w-100">
                    <div class="row">
                        <div class="col-10"><input type="text" class="form-control" placeholder="Type your product name here" name="keyword" value="{{ app('request')->input('keyword') }}"></div>
                        <div class="col-2"><button type="submit" name="submit" value="true" class="btn btn-primary w-100">Search</button></div>
                    </div>
                </form>

                <div class="collapse navbar-collapse ms-3" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        <!-- <li class="nav-item">
                        <a href="{{ url('#') }}" class="nav-link" >Shop Now</a><li class="nav-item">
                        </li>
                        <a href="{{ url('#') }}" class="nav-link" >About Us</a><li class="nav-item">
                        </li>
                        <a href="{{ url('#') }}" class="nav-link" >Product</a><li class="nav-item">
                        </li>
                        <a href="{{ url('#') }}" class="nav-link" >Catalogue</a><li class="nav-item">
                        </li>
                        <a href="{{ url('#') }}" class="nav-link" >Wholesale</a><li class="nav-item">
                        </li>
                        <a href="{{ url('#') }}" class="nav-link" >Retail</a>
                        <li class="nav-item">
                        <a href="{{ url('#') }}" class="nav-link" >News</a>
                        </li>
                        <li class="nav-item">
                        <a href="{{ url('#') }}" class="nav-link" >Contact Us</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="/cart"><i class="fa-solid fa-cart-shopping"></i> Cart <span class="dot">{{ $cartTotalItems }}</span></a>
                        </li>
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-user"></i> {{ __('Signin') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="fa-solid fa-address-card"></i> {{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/my-orders">My Orders</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="menu-bar">
            <div class="container">
                <div class="row">
                    @foreach ($categories as $key => $category)
                    <div class="col-2 btn-group dropdown">
                        <button type="button" redirect="/search?cat_id={{ $category->id }}" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $category->name }}
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($category->subCategories as $subCategory)
                            <li><a class="dropdown-item" href="/search?cat_id={{ $subCategory->id }}">{{ $subCategory->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>

        <footer>
            © Copyright by YCC Company 2022, Powered by CICT Solutions |
            <a href="/contact">Contact Us</a>
        </footer>
    </div>
</body>

</html>