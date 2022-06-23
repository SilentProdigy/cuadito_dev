<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cuadito') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ App::environment('local') ? asset('images/logo/logo.png') : secure_asset('images/logo/favicon.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <script src="https://kit.fontawesome.com/7a6e9affc7.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-md navbar-light bg-white fixed-top">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <img src="{{asset('images/logo/logo.png')}}" height="50" alt="YCC Logo" loading="lazy" />
            </a>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto flex-row">
                <!-- Avatar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/avatar/12.png') }}" class="rounded-circle" height="30" alt="Avatar" loading="lazy" />
                        &ensp;<span style="font-weight: normal">{{ auth('client')->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">My Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Settings</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('client.auth.logout') }}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('client.auth.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    {{-- @includeIf('panels.admin_sidebar', [auth()->user()->role => 'admin']) --}}
                    <a href="{{ route('client.dashboard') }}" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                        <i class="fas fa-home fa-fw me-3"></i><span>Home</span>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-square fa-fw me-3"></i><span>Companies</span>
                    </a>
                    
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-highlighter fa-fw me-3"></i><span>Projects</span>
                    </a>
                
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple sidebar-bottom">
                        <i class="fas fa-circle-question fa-fw me-3"></i><span>Help</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px; padding-left: 240px; padding-bottom: 100px">
        <div class="container pt-5">

            @include('panels.flash_messages')
            
            @yield('content')
        </div>
    </main>
    <!--Main layout-->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @yield('script')
</body>

</html>