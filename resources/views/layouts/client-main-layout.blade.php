<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }};URL='{{ route('client.auth.show-login-form') }}'">
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

    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css"
    rel="stylesheet"
    />
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/mdb.min.js') }}" defer></script>

    <!-- Croppie css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

    <!-- Croppie js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>

    <style>
        .nav-icons i {
        /* display: inline-block; */
        border-radius: 60px;
        box-shadow: 0 0 2px #888;
        padding: 10px 10px;
        background-color: #888;
        color: #fff;
        }
        .nav-icons i:hover{
            background-color: #777;
            color: #fff;
        }
        .auth-nav div{
            margin: 0 !important;
        }
    </style>

    @yield('style')

</head>

<body data-subscription="{{ json_encode(auth('client')->user()->active_subscription) }}">
    <nav id="main-navbar" class="navbar navbar-expand-md navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('images/logo/logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy" />
            </a>
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-client" aria-controls="navbar-client" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-client">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
                    <a href="{{ route('client.dashboard') }}" class="nav-link" aria-current="page">
                        <!-- <i class="fas fa-home fa-fw me-3"></i> -->
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('client.companies.index') }}" class="nav-link">
                        <!-- <i class="fas fa-square fa-fw me-3"></i> -->
                        <span>Companies</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('client.projects.index') }}" class="nav-link">
                        <!-- <i class="fas fa-highlighter fa-fw me-3"></i> -->
                        <span>Projects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('client.listing.index') }}" class="nav-link">
                        <!-- <i class="fas fa-list fa-fw me-3"></i> -->
                        <span>Listing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('client.proposals.index') }}" class="nav-link">
                        <!-- <i class="fas fa-list fa-fw me-3"></i> -->
                        <span>Proposals</span>
                    </a>
                </li>

                {{-- 
                    <li class="nav-item">
                        <a href="{{ route('client.contacts.index') }}" class="nav-link">
                            <!-- <i class="fas fa-list fa-fw me-3"></i> -->
                            <span>Contacts</span>
                        </a>
                    </li> 
                
                    <li class="nav-item">
                        <a href="{{ route('client.inbox.index') }}" class="nav-link">
                            <!-- <i class="fas fa-list fa-fw me-3"></i> -->
                            <span>Messages</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <!-- <i class="fas fa-circle-question fa-fw me-3"></i> -->
                            <span>Help</span>
                        </a>
                    </li>
                    --}}
                    {{-- 
                    <li class="nav-item">
                        <a href="{{ route('client.notifications.index') }}" class="nav-link">
                            <!-- <i class="fas fa-list fa-fw me-3"></i> -->
                            <span>Notifications</span>
                        </a>
                    </li>
                --}}
                    <!-- <li class="nav-item">
                        <a href="{{ route('client.notifications.index') }}" class="nav-link position-relative">Notifications
                            @if(auth('client')->user()->have_unread_notifications)
                                <span class="position-absolute top-20 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ auth('client')->user()->unread_notifications_count }}
                                </span>
                            @endif
                        </a>
                    </li> -->
            </ul>
            <div class="auth-nav d-flex flex-row-reverse">
                <span class="dropdown">
                    <a class="nav-link text-muted dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="accountDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth('client')->user()->profile_picture_url }}" class="rounded-circle" height="40" alt="Avatar" loading="lazy" />
                        <!-- &ensp;<span style="font-weight: normal">{{ auth('client')->user()->name }}</span> -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                        <li>
                            <a class="dropdown-item nav-link" href="{{ route('client.profile.show', auth('client')->user()->id) }}">My Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item nav-link disabled" href="#">Terms & Privacy</a>
                        </li>
                        <li>
                            <a class="dropdown-item nav-link disabled" href="#">Help & Support</a>
                        </li>
                        <li>
                            <a class="dropdown-item nav-link" href="{{ route('client.auth.logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('client.auth.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </span>
                
                <span class="nav-icons">
                    <a href="{{ route('client.notifications.index') }}" class="nav-link position-relative">
                        <i class="fa-sharp fa-solid fa-bell"></i>
                        @if(auth('client')->user()->have_unread_notifications)
                            <span class="position-absolute top-20 start-80 translate-middle badge rounded-pill bg-danger">
                                {{ auth('client')->user()->unread_notifications_count }}
                            </span>
                        @endif
                    </a>
                </span>
                
                <span class="nav-icons">
                    <a href="{{ route('client.inbox.index') }}" class="nav-link">
                        <i class="fa-solid fa-comment"></i>
                        @if(auth('client')->user()->have_unopened_messages)
                            <span class="position-absolute top-20 start-80 translate-middle badge rounded-pill bg-danger">
                                {{ auth('client')->user()->have_unopened_messages_count }}
                            </span>
                        @endif
                    </a>
                </span>

            </div>
            
        </div>
    </nav>
    <header>
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <!-- Modal -->
    {{-- @if(!request()->routeIs('client.payments.result'))
        @include('client.includes.subscription_modal')
    @endif --}}

    
    <main style="margin-top: 78px;">
        <div class="container pt-5">
            @include('panels.flash_messages')
            
            @yield('content')
        </div>
        @include('client.includes.beta_test_popup')
    </main>
    <!--Main layout-->

    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50 mt-5 text-center">
        <div class="container">
            <ul class="nav justify-content-center border-bottom pb-3 mb-4 nav-footer">
                <li class="nav-item">
                <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
                    <a href="{{ route('client.dashboard') }}" class="nav-link" aria-current="page">
                        <!-- <i class="fas fa-home fa-fw me-3"></i> -->
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('client.companies.index') }}" class="nav-link">
                        <!-- <i class="fas fa-square fa-fw me-3"></i> -->
                        <span>Companies</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('client.projects.index') }}" class="nav-link">
                        <!-- <i class="fas fa-highlighter fa-fw me-3"></i> -->
                        <span>Projects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('client.listing.index') }}" class="nav-link">
                        <!-- <i class="fas fa-list fa-fw me-3"></i> -->
                        <span>Listing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('client.proposals.index') }}" class="nav-link">
                        <!-- <i class="fas fa-list fa-fw me-3"></i> -->
                        <span>Proposals</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('client.contacts.index') }}" class="nav-link">
                        <!-- <i class="fas fa-list fa-fw me-3"></i> -->
                        <span>Contacts</span>
                    </a>
                </li>
            </ul>
            <a href="#" class="d-flex align-items-center justify-content-center my-4 link-dark text-decoration-none">
                <img src="{{asset('images/logo/logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy" />
            </a>
            <p class="mb-0 text-muted">Powered by: <b>1MC Digital, Inc.</b></p>
        </div>
    </footer>

    

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @yield('script')

    {{-- @if(!request()->routeIs('client.payments.result'))
        <script>
            $(document).ready(function(){
                
                let subscription = $('body').data('subscription');
        
                if(!subscription) {
                    $("#subscriptionModal").modal('show');
                }
            });
      </script>
    @endif --}}
    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"
    ></script>
</body>
</html>