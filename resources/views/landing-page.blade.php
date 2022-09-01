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
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>

    <style>
      /* Carousel styling */
      #introCarousel,
      .carousel-inner,
      .carousel-item,
      .carousel-item.active {
        height: 100vh;
      }

      .carousel-item:nth-child(1) {
        background-image: url("{{ asset('images/slider/slider_bg_01.jpeg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }

      .carousel-item:nth-child(2) {
        background-image: url("{{ asset('images/slider/slider_bg_02.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }

      .carousel-item:nth-child(3) {
        background-image: url("{{ asset('images/slider/slider_bg_03.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }

      .owl-carousel .item {
          height: 10rem;
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 1rem;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #introCarousel {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style>
</head>
<body>
      <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;">
      <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand nav-link" target="_blank" href="https://mdbootstrap.com/docs/standard/">
            <img src="{{asset('images/logo/logo.png')}}" height="30" alt="Cuadito Logo" loading="lazy" />
        </a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
          aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link fw-normal" aria-current="page" href="#">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-normal" aria-current="page" href="#">Projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-normal" aria-current="page" href="#">Partners</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-normal" aria-current="page" href="#">Pricing</a>
            </li>
          </ul>

          <ul class="navbar-nav list-inline">
            <!-- Icons -->
            <li class="">
              <a class="nav-link" href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA" rel="nofollow"
                target="_blank">
                <i class="fab fa-youtube"></i>
              </a>
            </li>
            <li class="">
              <a class="nav-link" href="https://www.facebook.com/mdbootstrap" rel="nofollow" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://twitter.com/MDBootstrap" rel="nofollow" target="_blank">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://github.com/mdbootstrap/mdb-ui-kit" rel="nofollow" target="_blank">
                <i class="fab fa-github"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Carousel wrapper -->
    <div id="introCarousel" class="carousel slide carousel-fade shadow-2-strong" data-mdb-ride="carousel">
      <!-- Indicators -->
      <!-- <ol class="carousel-indicators">
        <li data-mdb-target="#introCarousel" data-mdb-slide-to="0" class="active"></li>
        <li data-mdb-target="#introCarousel" data-mdb-slide-to="1"></li>
        <li data-mdb-target="#introCarousel" data-mdb-slide-to="2"></li>
      </ol> -->

      <!-- Inner -->
      <div class="carousel-inner">
        <!-- Single item -->
        <div class="carousel-item active">
          <div class="mask" style="
                background: linear-gradient(
                  45deg,
                  rgba(242, 103, 34, 0.7),
                  rgba(255, 185, 1, 0.7) 100%
                );">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="text-white text-center">
                <h1 class="mb-3">Find Your Next Deal!</h1>
                <h5 class="mb-4">Online Auction is where everyone goes to shop, sell,and give, while discovering variety and affordability.</h5>
                
                <a class="btn btn-outline-light btn-lg m-2" href="#"
                  target="_blank" role="button">Get Started</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Single item -->
        <div class="carousel-item">
          <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="text-white text-center">
                <h2>You can place here any content</h2>
              </div>
            </div>
          </div>
        </div>

        <!-- Single item -->
        <div class="carousel-item">
          <div class="mask" style="
                background: linear-gradient(
                  45deg,
                  rgba(242, 103, 34, 0.7),
                  rgba(255, 185, 1, 0.7) 100%
                );
              ">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="text-white text-center">
                <h2>And cover it with any mask</h2>
                <a class="btn btn-outline-light btn-lg m-2"
                  href="https://mdbootstrap.com/docs/standard/content-styles/masks/" target="_blank" role="button">Learn
                  about masks</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Inner -->

      <!-- Controls -->
      <a class="carousel-control-prev" href="#introCarousel" role="button" data-mdb-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#introCarousel" role="button" data-mdb-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!-- Carousel wrapper -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5">
    <div class="container">
        <section id="logoCarousel">
            <div class="row">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                      <img src="{{ asset('images/slider/1mc_logo_v.png') }}"/>
                    </div>
                    <div class="item">
                      <img src="{{ asset('images/slider/partner_logo_01.png') }}"/>
                    </div>
                    <div class="item">
                      <img src="{{ asset('images/slider/partner_logo_02.png') }}"/>
                    </div>
                    <div class="item">
                      <img src="{{ asset('images/slider/partner_logo_03.png') }}"/>
                    </div>
                    <div class="item">
                      <img src="{{ asset('images/slider/partner_logo_04.png') }}"/>
                    </div>
                    <div class="item">
                      <img src="{{ asset('images/slider/partner_logo_05.png') }}"/>
                    </div>
                    <div class="item">
                      <img src="{{ asset('images/slider/partner_logo_06.png') }}"/>
                    </div>
                    <div class="item">
                      <img src="{{ asset('images/slider/partner_logo_07.png') }}"/>
                    </div>
                    <div class="item">
                      <img src="{{ asset('images/slider/partner_logo_08.png') }}"/>
                    </div>
                    <div class="item">
                      <img src="{{ asset('images/slider/partner_logo_09.png') }}"/>
                    </div>
                    <div class="item">
                      <img src="{{ asset('images/slider/partner_logo_10.png') }}"/>
                    </div>
                </div>
            </div>
        </section>
      <!--Section: Content-->
      <section>
        <div class="row mt-5">
          <div class="col-md-6 gx-5">
            <div class="bg-image hover-overlay ripple shadow-2-strong" data-mdb-ripple-color="light">
              <img src="{{ asset('images/landing_page/section01_img.jpg') }}" class="img-fluid" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </a>
            </div>
          </div>

          <div class="col-md-6 gx-5">
            <h4><strong>Facilis consequatur eligendi</strong></h4>
            <p class="text-muted">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis consequatur
              eligendi quisquam doloremque vero ex debitis veritatis placeat unde animi laborum
              sapiente illo possimus, commodi dignissimos obcaecati illum maiores corporis.
            </p>
            <p><strong>Doloremque vero ex debitis veritatis?</strong></p>
            <p class="text-muted">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod itaque voluptate
              nesciunt laborum incidunt. Officia, quam consectetur. Earum eligendi aliquam illum
              alias, unde optio accusantium soluta, iusto molestiae adipisci et?
            </p>
          </div>
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />

      <section class="text-center" id="pricing_table">
        <h4 class="mb-4"><strong>Pricing</strong></h4>

        <div class="btn-group mb-4" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary btn-orange active">Monthly billing</button>
          <button type="button" class="btn btn-primary btn-yellow">
            Annual billign <small>(2 months FREE)</small>
          </button>
        </div>

        <div class="row gx-lg-5">

          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4">

            <!-- Card -->
            <div class="card">

              <div class="card-header bg-white py-3">
                <p class="text-uppercase small mb-2"><strong>Free</strong></p>
                <h5 class="mb-0">Free</h5>
              </div>

              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                </ul>
              </div>

              <div class="card-footer bg-white py-3">
                <button type="button" class="btn btn-success btn-gray btn-sm">Get it</button>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4">

            <!-- Card -->
            <div class="card border border-orange">

              <div class="card-header bg-white py-3">
                <p class="text-uppercase small mb-2"><strong>Essential</strong></p>
                <h5 class="mb-0">$19/month</h5>
              </div>

              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                </ul>
              </div>

              <div class="card-footer bg-white py-3">
                <button type="button" class="btn btn-primary btn-orange btn-sm">Buy now</button>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4">

            <!-- Card -->
            <div class="card">

              <div class="card-header bg-white py-3">
                <p class="text-uppercase small mb-2"><strong>Advanced</strong></p>
                <h5 class="mb-0">$49/month</h5>
              </div>

              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                </ul>
              </div>

              <div class="card-footer bg-white py-3">
                <button type="button" class="btn btn-info btn-yellow btn-sm">Buy now</button>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4">

            <!-- Card -->
            <div class="card">

              <div class="card-header bg-white py-3">
                <p class="text-uppercase small mb-2"><strong>Enterprise</strong></p>
                <h5 class="mb-0">$189/month</h5>
              </div>

              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                  <li class="list-group-item">Feature</li>
                </ul>
              </div>

              <div class="card-footer bg-white py-3">
                <button type="button" class="btn btn-info btn-yellow btn-sm">Buy now</button>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!--Grid column-->

        </div>
      </section>

      <!--Section: Content-->
      <section class="text-center">
        <h4 class="mb-5"><strong>Featured Projects</strong></h4>

        <div class="row">
          <div class="col-lg-4 col-md-12 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="https://mdbootstrap.com/img/new/standard/nature/184.jpg" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Job Title 001</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the
                  card's content.
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="https://mdbootstrap.com/img/new/standard/nature/023.jpg" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Job Title 002</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the
                  card's content.
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="https://mdbootstrap.com/img/new/standard/nature/111.jpg" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Job Title 003</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the
                  card's content.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />

      <!--Section: Content-->
      <section class="mb-5">
        <h4 class="mb-5 text-center"><strong>Facilis consequatur eligendi</strong></h4>

        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <form>
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="form3Example1" class="form-control" />
                    <label class="form-label" for="form3Example1">First name</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="form3Example2" class="form-control" />
                    <label class="form-label" for="form3Example2">Last name</label>
                  </div>
                </div>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" id="form3Example3" class="form-control" />
                <label class="form-label" for="form3Example3">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="form3Example4" class="form-control" />
                <label class="form-label" for="form3Example4">Password</label>
              </div>

              <!-- Checkbox -->
              <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" checked />
                <label class="form-check-label" for="form2Example3">
                  Subscribe to our newsletter
                </label>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-orange btn-block mb-4">
                Sign up
              </button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>or sign up with:</p>
                <button type="button" class="btn btn-primary btn-orange btn-floating mx-1">
                  <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-primary btn-orange btn-floating mx-1">
                  <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-primary btn-orange btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-primary btn-orange btn-floating mx-1">
                  <i class="fab fa-github"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!--Section: Content-->
    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="bg-light text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3 text-white" style="background-color: rgba(242, 103, 34);">
      © 2020 Copyright
      <a class="text-white" href="#">1MC Digital Inc.</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!--Footer-->
<!-- MDB -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Custom scripts -->
<script type="text/javascript" src="js/script.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        });
    });
</script>
</body>
</html>