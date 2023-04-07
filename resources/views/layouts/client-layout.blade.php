<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }};URL='{{ route('client.auth.show-login-form') }}'">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cuadito') }} | @yield('page_title') </title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ App::environment('local') ? asset('images/logo/logo.png') : secure_asset('images/logo/favicon.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <script src="https://kit.fontawesome.com/7a6e9affc7.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard-style.css') }}" rel="stylesheet" />
    
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

    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet" />

    @yield('style')
    <style>
        body{
            background-color: #e6e7e7e7;
        }
        .submenu li{
            margin-bottom: 1rem;
        }
        .submenu li a{
            color: #d3d3d3;
        }
        .submenu li a:hover{
            color: #fff;
        }
        .submenu{ 
            list-style: none; 
            padding: 0 0 0 4rem;
        }
        .right-nav{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #header{padding: 24px 60px;}
        
        form.nosubmit {
            border: none;
            padding: 0;
        }

        input.nosubmit {
            outline-offset: 0;
            border: 1px solid #555;
            width: 100%;
            padding-left: 20%;
            border-radius: 50px;
            background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 13px center;
        }
        input.nosubmit:focus{
            border-color: #ff5f00 !important;
            box-shadow: inset 0 0 0 1px #ff5f00 !important;
        }
        
    </style>

</head>

<body data-subscription="{{ json_encode(auth('client')->user()->active_subscription) }}" id="body-pd">
    <header class="header shadow-sm" id="header">
        <div class="header_logo">
            <img src="{{asset('images/logo/logo.png')}}" height="70" alt="Cuadito Logo" loading="lazy" />
        </div>
        <div class="right-nav">

            <form class="nosubmit">
                <input class="nosubmit form-control" type="search" placeholder="Search...">
            </form>


            <span class="nav-icons">
                <a href="{{ route('client.inbox.index') }}" class="nav-link">
                    <i class="fa-solid fa-comment nav_icon text-black"></i>
                    @if(auth('client')->user()->have_unopened_messages)
                        <span class="position-absolute top-20 start-80 translate-middle badge rounded-pill bg-danger">
                            {{ auth('client')->user()->have_unopened_messages_count }}
                        </span>
                    @endif
                </a>
            </span>
            
            <span class="nav-icons" style="margin-right: 1rem;">
                <a href="{{ route('client.notifications.index') }}" class="nav-link">
                    <i class="fa-sharp fa-solid fa-bell nav_icon text-black"></i>
                    @if(auth('client')->user()->have_unread_notifications)
                        <span class="position-absolute top-20 start-80 translate-middle badge rounded-pill bg-danger">
                            {{ auth('client')->user()->unread_notifications_count }}
                        </span>
                    @endif
                </a>
            </span>
            <span class="dropdown">
                <a class="nav-link text-muted dropdown-toggle hidden-arrow d-flex align-items-center header_img" href="#" id="accountDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
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
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="dashboard_nav">
            <div>
                <div class="nav_list">
                    <a href="{{ route('client.dashboard') }}" class="nav_link active">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                        <i class="bx bx-angle-down text-white"></i>
                    </a>
                    <!-- <a href="#" class="nav_link">
                        <i class='bx bx-folder nav_icon'></i>
                        <span class="nav_name">Projects</span>
                    </a> -->
                    <a href="javascript:void(0);" class="nav_collapse nav_link has-submenu" id="has-submenu">
                        <i class='bx bx-folder nav_icon'></i>
                        <span class="nav_name">Projects</span>
                    </a>
                    <ul class="submenu collapse ml-3" id="submenu">
                        <li><a href="{{ route('client.listing.index') }}" class="fw-normal">Projects Available</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('client.projects.index') }}" class="fw-normal">Your Projects </a></li>
                    </ul>
                    <a href="#" class="nav_link">
                        <i class='bx bx-file nav_icon'></i>
                        <span class="nav_name">Proposals</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">Reports</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-cog nav_icon'></i>
                        <span class="nav_name">Settings</span>
                    </a>
                </div>
            </div>
            <div class="header_toggle text-white">
                <i class='bx bx-menu nav_icon' id="header-toggle"></i>
            </div>
        </nav>
    </div>
    <!--Container Main start-->
    <div id="main-content">
        @yield('content')
    </div>

    

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

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
        
        const showNavbar = (toggleId, navId, bodyId, menuSub, headerTogg) =>{
            const toggle = document.getElementsByClassName(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            submenu = document.getElementById(menuSub),
            headerToggle = document.getElementById(headerTogg)
            
            // Validate that all variables exist
            if(toggle && nav && bodypd && submenu){
                for(var i = 0; i < toggle.length; i++){
                    toggle[i].addEventListener('click', ()=>{
                        // show navbar
                        nav.classList.toggle('dashboard-show')
                        // change icon
                        headerToggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')

                        submenu.classList.remove('dashboard-show')
                    }, false)
                }
            }
        }
        
        showNavbar('nav_icon','nav-bar','body-pd', 'submenu', 'header-toggle')
        
        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')
        
        function colorLink(){
        if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
        this.classList.add('active')
        }
        }
        linkColor.forEach(l=> l.addEventListener('click', colorLink))
        
            // Your code to run since DOM is loaded and ready
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
        document.querySelectorAll('.dashboard_nav .nav_collapse').forEach(function(element){
            
            
            element.addEventListener('click', function (e) {

            let nextEl = element.nextElementSibling;
            let parentEl  = element.parentElement;	

                if(nextEl) {
                    e.preventDefault();	
                    let mycollapse = new bootstrap.Collapse(nextEl);
                    
                    if(nextEl.classList.contains('show')){
                        mycollapse.hide();
                    } else {
                        mycollapse.show();
                        // find other submenus with class=show
                        var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                        // if it exists, then close all of them
                        if(opened_submenu){
                        new bootstrap.Collapse(opened_submenu);
                        }
                    }
                }
            }); // addEventListener
        }) // forEach
        }); 
    </script>
    
    <script src="{{ asset('js/card-pagination.js') }}"></script>
</body>
</html>