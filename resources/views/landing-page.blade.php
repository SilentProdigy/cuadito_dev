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
                <a href="#features" class="btn landing-page-btn btn-rounded mt-5">Get Started</a>
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
                <img src="{{asset('images/elements/collaboration-icon.png')}}" class="img-responsive features-icons"/>
                <h5 class="font-weight-bold mb-4">Collaborations</h5>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam,
                  aperiam minima assumenda deleniti hic.</p>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
                <img src="{{asset('images/elements/communication-icon.png')}}" class="img-responsive features-icons"/>
                <h5 class="font-weight-bold mb-4">Communications</h5>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam,
                  aperiam minima assumenda deleniti hic.</p>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
                <img src="{{asset('images/elements/collaboration-icon.png')}}" class="img-responsive features-icons"/>
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

            <div class="row">

              <!-- Grid column -->
              <div class="col-lg-4 col-md-6 mb-5">
                <div class="bg-image hover-zoom">
                  <img src="https://mdbootstrap.com/img/Photos/Horizontal/Architecture/4-col/img%20%281%29.jpg"
                    class="img-fluid">
                </div>
                <h5 class="mt-4 text-center">Advertisement & Marketing</h5>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-lg-4 col-md-6 mb-5">
                <div class="bg-image hover-zoom">
                  <img src="https://mdbootstrap.com/img/Photos/Horizontal/Architecture/4-col/img%20%282%29.jpg"
                    class="img-fluid">
                </div>

                <h5 class="mt-4 text-center">Construction</h5>

              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-lg-4 col-md-6 mb-5">

                <div class="bg-image hover-zoom">
                  <img src="https://mdbootstrap.com/img/Photos/Horizontal/Architecture/4-col/img%20%283%29.jpg"
                    class="img-fluid">
                </div>

                <h5 class="mt-4 text-center">Training & Coaching</h5>

              </div>
              <!-- Grid column -->

            </div>

        </section>
        <!-- Section: Services -->

     </div>
     

     <div class="streak streak-photo streak-md"
        style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/City/12-col/img%20%2822%29.jpg');">
        <div class="flex-center mask rgba-cuadito-dark center">
          <div class="text-center text-white">
            <h2 class="h2-responsive mb-5"><i class="fas fa-quote-left" aria-hidden="true"></i> If you want to go fast, go alone;<br>if you want to go far, go together. <i class="fas fa-quote-right" aria-hidden="true"></i></h2>
            <h5 class="text-center font-italic wow fadeIn" data-wow-delay="0.2s">~ African Proverb</h5>
          </div>
        </div>
      </div>

    <div class="container">

      <!-- Section: Pricing -->
      <section class="mt-4 mb-5">

        <!-- Section heading -->
        <h3 class="text-center text-uppercase font-weight-bold mb-5 mt-5 pt-5 wow fadeIn" data-wow-delay="0.2s">Our
          pricing plans</h3>

        <!-- Section description -->
        <p class="text-center grey-text my-5 w-responsive mx-auto wow fadeIn" data-wow-delay="0.2s">Lorem ipsum dolor
          sit amet, consectetur adipisicing elit. Laborum quas, eos officia maiores ipsam ipsum dolores reiciendis ad
          voluptas, animi obcaecati adipisci sapiente mollitia? Autem delectus quod accusamus tempora, aperiam minima
          assumenda deleniti.</p>

        <div class="row pt-4">
          <!-- Grid column -->
          <div class="col-lg-4 col-md-12 mt-1 mb-4">

          </div>
        </div>

      </section>
      <!-- Section: Pricing -->
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