<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
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

    <!-- OWL CAROUSEL -->
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet"> -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <style>
      html,
      body{
        height: 100%;
        min-height: 100%;
      }

  
    </style>
    @yield('styles')
</head>
<body class="landing-page">
  <!-- HEADER -->
   <header>
      <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="nav navbar-nav ms-auto text-center">
            <li class="nav-item border-bottom">
              <a class="nav-link text-black" href="{{ route('guest.about') }}">About</a>
            </li>
            <!-- <li class="nav-item border-bottom">
              <a class="nav-link text-black" href="{{ route('guest.projects') }}">Projects</a>
            </li> -->
            {{-- <li class="nav-item border-bottom">
              <a class="nav-link text-black" href="{{ route('guest.pricing') }}">Pricing</a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link text-black" href="{{ route('guest.contact') }}">Contact</a>
            </li>
            {{-- 
            <li class="py-3">
              <a href="{{ route('client.auth.show-login-form') }}" class="btn btn-orange btn-rounded">Login</a>
            </li>
            --}}
          </ul>
        </div>
      </div>
      <nav class="navbar navbar-dark navbar-expand-md bg-white justify-content-center fixed-top scrolling-navbar">
        <div class="container">
          <a class="navbar-brand d-flex w-50 me-auto" href="{{ route('home') }}">
            <img src="{{asset('images/logo/logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy" />
          </a>
            <button class="navbar-toggler mobile-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
              <i class="fa fa-bars"></i>
            </button>
            <div class="navbar-collapse collapse" id="collapsingNavbar3">
                <ul class="nav navbar-nav ms-auto justify-content-end">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.about') }}">About</a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.projects') }}">Projects</a>
                  </li> -->
                  {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.pricing') }}">Pricing</a>
                  </li> --}}
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.contact') }}">Contact</a>
                  </li>
                  {{-- 
                  <li class="px-3">
                    <a href="{{ route($data['auth_url']) }}" class="btn btn-orange btn-rounded">{{$data['auth_text']}}</a>
                  </li>
                  --}}
                </ul>
            </div>
        </div>
      </nav>

      @yield('content')

   <!-- FOOTER -->
   <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-white text-black-50 text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xs-12">
            <img src="{{asset('images/logo/logo.png')}}" height="150" alt="Cuadito Logo" loading="lazy" />
          </div>
          <div class="col-md-6 col-lg-6 col-xs-12 d-flex align-items-center justify-content-center">
            <div class="text-center fs-3">
              
            <h3 class="display-6 text-center text-uppercase">Connect with us</h3>
              <!-- Icon -->
              <a class="text-reset me-4" href="https://www.facebook.com/1mcDigital">
                <i class="fab fa-facebook-f"></i>
              </a>
  
              <a class="text-reset me-4" href="https://www.instagram.com/1mcdigital/">
                <i class="fab fa-instagram"></i>
              </a>
              
              <a class="text-reset me-4" href="https://www.linkedin.com/company/1mc-digital-inc/">
                <i class="fab fa-linkedin"></i>
              </a>
            </div>
          </div>
        </div>
        <hr class="hr-light my-4">
        <p class="mb-0 text-muted">Powered by: <b>1MC Digital, Inc.</b></p>
      </div>
  </footer>


  <!-- Custom scripts -->
  @yield('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
  <script>
    new WOW().init();

    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll < 300){
            $('.fixed-top').css('background', 'white');
            $('.fixed-top').css('box-shadow', 'none');
        } else{
            $('.fixed-top').css('background', 'rgba(255, 255, 255, 1)');
            $('.fixed-top').css('transition', '0.5s');
            $('.fixed-top').css('box-shadow', '0 .12rem .30rem rgba(0, 0, 0, 0.6)');
        }
    });
  </script>
</body>
</html>