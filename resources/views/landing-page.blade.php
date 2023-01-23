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
      body,
      header,
      .view.jarallax {
        height: 100%;
        min-height: 100%;
      }
  
    </style>
</head>
<body class="landing-page">
  <!-- HEADER -->
   <header>
      <!-- Navbar -->
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
        <!-- Container wrapper -->
        <div class="container">
          <!-- Toggle button -->
          <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars"></i>
          </button>

          <!-- Collapsible wrapper -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
              <img src="{{asset('images/logo/logo.png')}}" height="50" alt="Cuadito Logo" loading="lazy" />
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Projects</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
            </ul>
            <!-- Left links -->
          </div>
          <!-- Collapsible wrapper -->

          <!-- Right elements -->
          <div class="d-flex align-items-center">
            <!-- Icon -->
            <a class="text-reset me-3" href="#">
              <i class="fab fa-facebook-f"></i>
            </a>

            <a class="text-reset me-3" href="#">
              <i class="fab fa-instagram"></i>
            </a>
            
            <a class="text-reset me-3" href="#">
              <i class="fab fa-twitter"></i>
            </a>
          </div>
          <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
      </nav>

      <div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}'>
        <div class="mask rgba-cuadito-dark">
          <div class="container h-100 d-flex justify-content-center align-items-center">
            <div class="row smooth-scroll">
              <div class="col-md-12 text-center">
                <div class="text-white wow fadeInDown">
                  <h1 class="display-4 text-uppercase font-weight-bold mt-5 mt-xl-2">Find Your Next Deal!</h1>
                  <hr class="hr-light my-4">
                  <h5 class="mb-4">An online project-bidding management system that helps companies to post projects, open biddings, submit proposals and connects with other companies within this application.</h5>
                </div>
                <a href="#features" data-offset="100" class="btn bg-white btn-rounded mt-5"
                  data-wow-delay="0.2s">Get Started</a>
              </div>
            </div>
          </div>
        </div>
      </div>
   </header>

   <!-- MAIN -->
   <main>
     <div class="container">
       <!-- Features -->
       <section id="features" class="mb-3 mt-5 pt-4 pb-3">
          <!-- Section heading -->
          <h3 class="text-center text-uppercase font-weight-bold mb-5 mt-4">We Bring You Your Right Partners</h3>

          <!-- Section description -->
          <p class="text-center text-muted my-5 w-responsive mx-auto">Lorem ipsum dolor
            sit amet, consectetur adipisicing elit. Laborum quas, eos officia maiores ipsam ipsum dolores reiciendis ad
            voluptas, animi obcaecati adipisci sapiente mollitia? Autem delectus quod accusamus tempora, aperiam minima
            assumenda deleniti.</p>

            <!-- Grid row -->
            <div class="row text-center">

              <!-- Grid column -->
              <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
                <i class="fas fa-handshake text-orange fa-4x mb-4"></i>
                <h5 class="font-weight-bold mb-4">Collaborations</h5>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam,
                  aperiam minima assumenda deleniti hic.</p>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
                <i class="fas fa-comment text-orange fa-4x mb-4"></i>
                <h5 class="font-weight-bold mb-4">Communications</h5>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam,
                  aperiam minima assumenda deleniti hic.</p>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
                <i class="fas fa-shield text-orange fa-4x mb-4"></i>
                <h5 class="font-weight-bold mb-4">Security</h5>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam,
                  aperiam minima assumenda deleniti hic.</p>
              </div>
              <!-- Grid column -->

            </div>
            <!-- Grid row -->
       </section>

       <!-- End Features -->

       <hr class="my-5">

        <!-- Section: Services -->
        <section id="services" class="pb-5 mb-5">

          <!-- Section heading -->
          <h3 class="text-center text-uppercase font-weight-bold mb-5 mt-5 pt-4" data-wow-delay="0.2s">Industries We Serve</h3>

          <!-- Section description -->
          <p class="text-center grey-text mt-5 w-responsive mx-auto wow fadeIn" data-wow-delay="0.2s">Lorem ipsum dolor
            sit amet, consectetur adipisicing elit. Laborum quas, eos officia maiores ipsam ipsum dolores reiciendis ad
            voluptas, animi obcaecati adipisci sapiente mollitia? Autem delectus quod accusamus tempora, aperiam minima
            assumenda deleniti.</p>

            <!-- Tabs navs -->
            <ul class="nav nav-tabs nav-fill mb-3" id="ex-with-icons" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex-with-icons-tab-1" data-mdb-toggle="tab" href="#ex-with-icons-tabs-1" role="tab"
                  aria-controls="ex-with-icons-tabs-1" aria-selected="true"><i class="fas fa-chart-pie fa-fw me-2"></i>Sales</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#ex-with-icons-tabs-2" role="tab"
                  aria-controls="ex-with-icons-tabs-2" aria-selected="false"><i class="fas fa-chart-line fa-fw me-2"></i>Subscriptions</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#ex-with-icons-tabs-3" role="tab"
                  aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fas fa-cogs fa-fw me-2"></i>Settings</a>
              </li>
            </ul>
            <!-- Tabs navs -->

            <!-- Tabs content -->
            <div class="tab-content" id="ex-with-icons-content">
              <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel" aria-labelledby="ex-with-icons-tab-1">
                Tab 1 content
              </div>
              <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                Tab 2 content
              </div>
              <div class="tab-pane fade" id="ex-with-icons-tabs-3" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                Tab 3 content
              </div>
            </div>
            <!-- Tabs content -->

        </section>
        <!-- Section: Services -->

     </div>
   </main>

   <!-- FOOTER -->
   <footer></footer>


  <!-- Custom scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
  <script>
    new WOW().init();

    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll < 300){
            $('.fixed-top').css('background', 'transparent');
        } else{
            $('.fixed-top').css('background', 'rgba(11, 0, 20, 1)');
            $('.fixed-top').css('transition', '0.5s');
        }
    });

  </script>
</body>
</html>