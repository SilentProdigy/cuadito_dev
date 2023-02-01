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
</head>
<body class="landing-page">
  <!-- HEADER -->
   <header>
      <!-- Navbar -->
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar bg-white">
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
            <a class="navbar-brand" href="#">
              <img src="{{asset('images/logo/logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy" />
            </a>
          </div>
          <!-- Collapsible wrapper -->

          <!-- Right elements -->
          <div class="d-flex align-items-center">
            <!-- Left links -->
            <ul class="navbar-nav d-flex">
              <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#projects">Projects</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pricing">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#contacts">Contact</a>
              </li>
              <li class="px-3">
                <a href="{{ route('client.auth.show-login-form') }}" class="btn btn-orange btn-rounded">Login</a>
              </li>
            </ul>
            <!-- Left links -->
            
            <!-- Icon -->
            <!-- <a class="text-reset me-3" href="#">
              <i class="fab fa-facebook-f"></i>
            </a>

            <a class="text-reset me-3" href="#">
              <i class="fab fa-instagram"></i>
            </a>
            
            <a class="text-reset me-3" href="#">
              <i class="fab fa-twitter"></i>
            </a> -->
          </div>
          <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
      </nav>

      <div id="home">
        <!-- <div class="row">
          <div class="col-md-6 col-xs-12 col-lg-6">
          </div>
          <div class="col-md-6 col-xs-12 col-lg-6">
            <h1 class="display-4 text-uppercase font-weight-bold mt-5 mt-xl-2">Find Your Next Deal!</h1>
            <hr class="hr-light my-4">
            <h5 class="mb-4">An online project-bidding management system that helps companies to post projects, open biddings, submit proposals and connects with other companies within this application.</h5>
          </div>
        </div> -->
        <div>
          <div class="container d-flex justify-content-center align-items-center banner-cuadito">
            <div class="row smooth-scroll">
              <div class="col-md-6">
                <div class="hover-zoom">
                  <img src="{{ asset('images/banners/collaboration-vector.png') }}"
                    class="img-fluid">
                </div>
              </div>
              <div class="col-md-6 p-5">
                <div class="wow fadeInDown">
                  <h1 class="display-3 text-uppercase fw-bold font-weight-bold mt-5 mt-xl-2">Better Connections,<br>Better Deals</h1>
                  <h5 class="mb-4 fw-normal">Get projects and suppliers with ease.<br>Make sure your business is the most efficient and profitable it can be with Cuadito - the perfect platform for businesses.</h5>
                </div>
                <a href="{{ route('client.auth.show-register-form') }}" class="btn landing-page-btn btn-rounded mt-5 fs-5">Get Started <i class="fa fa-angle-right"></i> </a>
              </div>
            </div>
          </div>
          <div class="container pt-5 d-flex justify-content-center align-items-center">
            <div class="col-md-5 col-lg-5 col-xs-12">
              <h3 class="display-6 fw-bold" data-wow-delay="0.2s">Cuadito is your one-stop platform tailored for any industry</h3>
            </div>
            <div class="col-md-7 col-lg-7 col-xs-12 p-4">
              <div class="row g-2 py-5">
                <div class="col-lg-4 col-md-4">
                  <div class="rounded-9 bg-white d-flex justify-content-center align-items-center" style="height: 100px;">
                    
                    <div>
                      <div class="d-flex justify-content-center align-items-center h-100 text-center p-2">
                        <h5 class="d-flex justify-content-center">Advertisement & Marketing</h5>
                      </div>
                    </div>
                  </div>
                </div>
      
                <div class="col-lg-4 col-md-4">
                  <div class="rounded-9 bg-white d-flex justify-content-center align-items-center" style="height: 100px;">
                    
                    <div>
                      <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h5 class="d-flex justify-content-center">Construction</h5>
                      </div>
                    </div>
                  </div>
                </div>
      
                <div class="col-lg-4 col-md-4">
                  <div class="rounded-9 bg-white d-flex justify-content-center align-items-center" style="height: 100px;">
                    
                    <div>
                      <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h5 class="d-flex justify-content-center">Training & Coaching</h5>
                      </div>
                    </div>
                  </div>
                </div>
      
                <div class="col-lg-4 col-md-4">
                  <div class="rounded-9 bg-white d-flex justify-content-center align-items-center" style="height: 100px;">
                    
                    <div>
                      <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h5 class="d-flex justify-content-center">IT Industry</h5>
                      </div>
                    </div>
                  </div>
                </div>
      
                <div class="col-lg-4 col-md-4">
                  <div class="rounded-9 bg-white d-flex justify-content-center align-items-center" style="height: 100px;">
                    
                    <div>
                      <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h5 class="d-flex justify-content-center">Food & Beverages</h5>
                      </div>
                    </div>
                  </div>
                </div>
      
                <div class="col-lg-4 col-md-4">
                  <div class="rounded-9 bg-white d-flex justify-content-center align-items-center" style="height: 100px;">
                    
                    <div>
                      <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h5 class="d-flex justify-content-center">Art & Entertainment</h5>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-4">
                  <div class="rounded-9 bg-white d-flex justify-content-center align-items-center" style="height: 100px;">
                    
                    <div>
                      <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h5 class="d-flex justify-content-center">IT Industry</h5>
                      </div>
                    </div>
                  </div>
                </div>
      
                <div class="col-lg-4 col-md-4">
                  <div class="rounded-9 bg-white d-flex justify-content-center align-items-center" style="height: 100px;">
                    
                    <div>
                      <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h5 class="d-flex justify-content-center">Food & Beverages</h5>
                      </div>
                    </div>
                  </div>
                </div>
      
                <div class="col-lg-4 col-md-4">
                  <div class="rounded-9 bg-white d-flex justify-content-center align-items-center" style="height: 100px;">
                    
                    <div>
                      <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h5 class="d-flex justify-content-center">Art & Entertainment</h5>
                      </div>
                    </div>
                  </div>
                </div>
      
      
              </div>
            </div>
              
              <!-- <hr class="hr-light my-4"> -->
            
          </div>
        </div>
      </div>
   </header>

   <!-- MAIN -->
   <main>
     <div class="container" id="about">

      <!-- Section: Services -->
      <!-- <section id="projects" class="py-5 mb-5"> -->

        <!-- <h3 class="text-center text-uppercase font-weight-bold" data-wow-delay="0.2s">Industries We Serve</h3> -->

        <!-- Section description -->
        <!-- <p class="text-center text-muted w-responsive mx-auto wow fadeIn" data-wow-delay="0.2s">Bringing together entrepreneurs from various industries on a single platform, enabling them to connect easily and do business efficiently as they grow with one another.</p> -->

      <!-- </section> -->
      <!-- Section: Services -->

       <!-- Features -->
       <section id="features" class="mb-3 pb-3 py-5 text-center">
        <!-- <img src="{{asset('images/logo/logo.png')}}" height="200" alt="Cuadito Logo" loading="lazy" />
        <p class="text-center text-muted my-5 w-responsive mx-auto">Cuadito is an online project-bidding management system that helps companies to post projects, open biddings, submit proposals and connects with other companies within this application.</p> -->

        <!-- <img src="{{ asset('images/elements/features-dashboard.gif') }}" class="img-fluid"> -->

          <!-- Section heading -->
          <h3 class="display-6 text-center text-uppercase font-weight-bold mt-4">Unlock your Business Success with Cuadito</h3>

          <!-- Section description -->
          <h4 class="text-center mb-3 w-responsive mx-auto">Reach your goals with the right connections!</h4>

            <!-- Grid row -->
            <div class="row pt-5 text-center">

              <!-- Grid column -->
              <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
                <img src="{{asset('images/elements/collaboration-icon.png')}}" class="img-responsive features-icons"/>
                <h5 class="font-weight-bold mb-4">Find the Best Suppliers</h5>
                <p class="text-muted">Our easy to use platform allows you to quickly and easily find the perfect supplier for your needs.</p>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
                <img src="{{asset('images/elements/communication-icon.png')}}" class="img-responsive features-icons"/>
                <h5 class="font-weight-bold mb-4">Get the Right Projects</h5>
                <p class="text-muted">No more tedious searching or cold calling - just find your ideal projects and submit your proposals.</p>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
                <img src="{{asset('images/elements/security-icon.png')}}" class="img-responsive features-icons"/>
                <h5 class="font-weight-bold mb-4">Dedicated Support</h5>
                <p class="text-muted">We are ready to help you with any challenge that comes your way.</p>
              </div>
              <!-- Grid column -->

            </div>
            <!-- Grid row -->

            <a href="{{ route('client.auth.show-register-form') }}" class="btn landing-page-btn btn-rounded mt-5 fs-5">Find out more </a>
       </section>

       <!-- End Features -->

       <!-- <hr class="my-5"> -->

    </div>

    <div class="container-fluid py-5 bg-light">
      <div class="container">

        <h3 class="display-6 text-center text-uppercase font-weight-bold mt-4">Make meaningful connections - join our trusted partners today!</h3>
        <div class="row pt-4 cuadito-logos">
          <div class="col-lg-3 col-md-3 col-xs-12">
            <img src="{{asset('images/company_logo/1mc-logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy">
          </div>
          <div class="col-lg-3 col-md-3 col-xs-12">
            <img src="{{asset('images/company_logo/amti-logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy">
          </div>
          <div class="col-lg-3 col-md-3 col-xs-12">
            <img src="{{asset('images/company_logo/amarantos-logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy">
          </div>
          <div class="col-lg-3 col-md-3 col-xs-12">
            <img src="{{asset('images/company_logo/rz-studios-logo.webp')}}" height="100" alt="Cuadito Logo" loading="lazy">
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">

      <div class="container">

        <!-- Section: Testimonials v.1 -->
        <section class="py-5">
          <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-xl-8 text-center">
              <h3 class="display-6 text-center text-uppercase font-weight-bold">Testimonials</h3>
              <p class="mb-4 pb-2 mb-md-5 pb-md-0  text-muted">
                Here's what our clients talk about us.
              </p>
            </div>
          </div>
        
          <div class="row text-center d-flex align-items-stretch">
            <div class="col-md-4 mb-5 mb-md-0 d-flex align-items-stretch">
              <div class="card testimonial-card">
                <div class="card-up" style="background-color: #F96B23;"></div>
                <div class="avatar mx-auto bg-white">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp"
                    class="rounded-circle img-fluid" />
                </div>
                <div class="card-body">
                  <h4 class="mb-4">Maria Smantha</h4>
                  <hr />
                  <p class="dark-grey-text mt-4">
                    <i class="fas fa-quote-left pe-2"></i>Lorem ipsum dolor sit amet eos adipisci,
                    consectetur adipisicing elit.
                  </p>
                  <ul class="list-unstyled d-flex justify-content-center mb-0">
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-5 mb-md-0 d-flex align-items-stretch">
              <div class="card testimonial-card">
                <div class="card-up" style="background-color: #FDDB2E;"></div>
                <div class="avatar mx-auto bg-white">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(2).webp"
                    class="rounded-circle img-fluid" />
                </div>
                <div class="card-body">
                  <h4 class="mb-4">Lisa Cudrow</h4>
                  <hr />
                  <p class="dark-grey-text mt-4">
                    <i class="fas fa-quote-left pe-2"></i>Neque cupiditate assumenda in maiores
                    repudi mollitia architecto.
                  </p>
                  <ul class="list-unstyled d-flex justify-content-center mb-0">
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star-half-alt fa-sm text-warning"></i>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-0 d-flex align-items-stretch">
              <div class="card testimonial-card">
                <div class="card-up" style="background-color: #773344;"></div>
                <div class="avatar mx-auto bg-white">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(9).webp"
                    class="rounded-circle img-fluid" />
                </div>
                <div class="card-body">
                  <h4 class="mb-4">John Smith</h4>
                  <hr />
                  <p class="dark-grey-text mt-4">
                    <i class="fas fa-quote-left pe-2"></i>Delectus impedit saepe officiis ab
                    aliquam repellat rem unde ducimus.
                  </p>
                  <ul class="list-unstyled d-flex justify-content-center mb-0">
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                      <i class="fas fa-star-half-alt fa-sm text-warning"></i>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Section: Testimonials v.1 -->

      </div>

    </div>

    <div class="container-fluid py-5 bg-light">
      <div class="container">
        <h3 class="display-6 text-center text-uppercase font-weight-bold">Explore our features</h3>
        <div class="row py-4">
          <div class="col-md-6">
            <div class="tab-content" id="v-tabs-tabContent">
              <div
                class="tab-pane fade show active"
                id="v-tabs-analyze"
                role="tabpanel"
                aria-labelledby="v-tabs-analyze-tab"
              >
              <img src="{{ asset('images/elements/features-dashboard.gif') }}" class="img-fluid border rounded">
              </div>
              <div
                class="tab-pane fade"
                id="v-tabs-publish"
                role="tabpanel"
                aria-labelledby="v-tabs-publish-tab"
              >
              <img src="{{ asset('images/elements/features-companies.gif') }}" class="img-fluid border rounded">
              </div>
              <div
                class="tab-pane fade"
                id="v-tabs-engage"
                role="tabpanel"
                aria-labelledby="v-tabs-engage-tab"
              >
              <img src="{{ asset('images/elements/features-engage.gif') }}" class="img-fluid border rounded">
              </div>
              <div
                class="tab-pane fade"
                id="v-tabs-connect"
                role="tabpanel"
                aria-labelledby="v-tabs-connect-tab"
              >
              <img src="{{ asset('images/elements/features-connect.gif') }}" class="img-fluid border rounded">
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xs-12 features-tabs">
            <div
              class="nav flex-column nav-tabs text-center"
              id="v-tabs-tab"
              role="tablist"
              aria-orientation="vertical"
            >
              <a
                class="nav-link active border rounded-pill"
                id="v-tabs-analyze-tab"
                data-mdb-toggle="tab"
                href="#v-tabs-analyze"
                role="tab"
                aria-controls="v-tabs-analyze"
                aria-selected="true"
                >Analyze</a
              >
              <a
                class="nav-link border rounded-pill"
                id="v-tabs-publish-tab"
                data-mdb-toggle="tab"
                href="#v-tabs-publish"
                role="tab"
                aria-controls="v-tabs-publish"
                aria-selected="false"
                >Publish</a
              >
              <a
                class="nav-link border rounded-pill"
                id="v-tabs-engage-tab"
                data-mdb-toggle="tab"
                href="#v-tabs-engage"
                role="tab"
                aria-controls="v-tabs-engage"
                aria-selected="false"
                >Engage</a
              >

              <a
                class="nav-link border rounded-pill"
                id="v-tabs-connect-tab"
                data-mdb-toggle="tab"
                href="#v-tabs-connect"
                role="tab"
                aria-controls="v-tabs-connect"
                aria-selected="false"
                >Connect</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
        style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/City/12-col/img%20%2822%29.jpg'); background-size: cover;">
        <div class="flex-center rgba-cuadito-dark center">
          <div class="text-center text-white">
            <h2 class="h2-responsive mb-5"><i class="fas fa-quote-left" aria-hidden="true"></i>&nbsp;Everything you’ve ever wanted is on the other side of fear.&nbsp;<i class="fas fa-quote-right" aria-hidden="true"></i></h2>
            <h5 class="text-center font-italic wow fadeIn" data-wow-delay="0.2s">~ George Addair</h5>
          </div>
        </div>
      </div>
     

     <!-- <div
        style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/City/12-col/img%20%2822%29.jpg');">
        <div class="flex-center rgba-cuadito-dark center">
          <div class="text-center text-white">
            <h2 class="h2-responsive mb-5"><i class="fas fa-quote-left" aria-hidden="true"></i> If you want to go fast, go alone;<br>if you want to go far, go together. <i class="fas fa-quote-right" aria-hidden="true"></i></h2>
            <h5 class="text-center font-italic wow fadeIn" data-wow-delay="0.2s">~ African Proverb</h5>
          </div>
        </div>
      </div> -->

    <!-- <div class="container" id="pricing">

      
      <section class="mt-4 mb-5 pb-5">

        
        <h3 class="text-center text-uppercase font-weight-bold mb-5 mt-5 pt-5 wow fadeIn" data-wow-delay="0.2s">Our
          pricing plans</h3>
          <p class="mb-4 pb-2 mb-md-5 pb-md-0 text-center text-muted">
            Experience a whole new level of making a partners today!
          </p>

        
        <div class="row pt-4 landing-page-pricing">
          
          <div class="col-xs-6 col-md-4">
            <div class="price-card">
              <h2>Silver</h2>
              <p class="price"><span>2,000.00</span>/ mo.</p>
              <ul class="pricing-offers">
                <li>20 Bids per month</li>
                <li>Unlimited Project Posting</li>
              </ul>
                <a href="{{ route('client.auth.show-register-form') }}" class="subscription_btn btn btn-orange">Subscribe Now</a>
            </div>
          </div>

          <div class="col-xs-6 col-md-4 highlight">
            <div class="price-card">
              <h2>Platinum</h2>
              <p class="price"><span>5,000.00</span>/ mo.</p>
              <ul class="pricing-offers">
                <li>20 Bids per month</li>
                <li>Unlimited Project Posting</li>
                <li>Company will be top-listed on bids.</li>
              </ul>
                <a href="{{ route('client.auth.show-register-form') }}" class="subscription_btn btn">Subscribe Now</a>
            </div>
          </div>

          <div class="col-xs-6 col-md-4">
            <div class="price-card">
              <h2>Gold</h2>
              <p class="price"><span>3,000.00</span>/ mo.</p>
              <ul class="pricing-offers">
                <li>30 Bids per month</li>
                <li>Unlimited Project Posting</li>
              </ul>
                <a href="{{ route('client.auth.show-register-form') }}" class="subscription_btn btn btn-orange">Subscribe Now</a>
            </div>
          </div>
        </div>

      </section>
      
    </div> -->

    <!-- <div class="container-fluid py-5 landing-contacts" id="contacts">
      <div class="container">
        
        <h3 class="text-center text-uppercase font-weight-bold mb-5 wow fadeIn" data-wow-delay="0.2s">contact
          us</h3>

        
        <p class="text-center my-5 w-responsive mx-auto wow fadeIn fw-light text-white-50" data-wow-delay="0.2s">We'd love to assist you in any way. Looking forward to hearing from you. </p>

        <div class="row">
          <div class="col-md-6 offset-md-3">
            <form>
              
              <div class="form-outline mb-4">
                <input type="text" id="landingpage-form-name" class="form-control" />
                <label class="form-label" for="landingpage-form-name">Name</label>
              </div>
            
              
              <div class="form-outline mb-4">
                <input type="email" id="landingpage-form-email" class="form-control" />
                <label class="form-label" for="landingpage-form-email">Email address</label>
              </div>
            
              
              <div class="form-outline mb-4">
                <textarea class="form-control" id="form4Example3" rows="4"></textarea>
                <label class="form-label" for="form4Example3">Message</label>
              </div>
            
              
              <button type="submit" class="btn btn-white btn-block mb-4">Send</button>
            </form>
          </div>
        </div>


        
        <div class="row text-center mt-4">

          
          <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
            <i class="fa fa-phone-alt"></i>
            <h5 class="fw-light mb-4 mt-2">+639473299876</h5>
          </div>
          

          
          <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
            <i class="fa fa-paper-plane"></i>
            <h5 class="fw-light mb-4 mt-2">inquiries@1mcdigital.com</h5>
          </div>
          

          
          <div class="col-md-4 mb-1 mt-1 wow fadeIn" data-wow-delay="0.4s">
            <i class="fa fa-globe"></i>
            <h5 class="fw-light mb-4 mt-2">www.cuadito.com.ph</h5>
          </div>
          

        </div>
        
      </div>
    </div> -->
      
   </main>

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

      <!-- <div class="container">
          <div class="text-center mb-5 fs-5">
            
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
          <ul class="nav justify-content-center border-bottom pb-3 mb-4 nav-footer">
              <li class="nav-item">
                  <a href="#about" class="nav-link" aria-current="page">
                      
                      <span>About</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#projects" class="nav-link">
                      
                      <span>Projects</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#pricing" class="nav-link">
                      
                      <span>Pricing</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#contacts" class="nav-link">
                      
                      <span>Contact</span>
                  </a>
              </li>
          </ul>
          <a href="#" class="d-flex align-items-center justify-content-center my-4 link-dark text-decoration-none">
              <img src="{{asset('images/logo/logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy" />
          </a>
          <p class="mb-0 text-muted">Powered by: <b>1MC Digital, Inc.</b></p>
      </div> -->
  </footer>


  <!-- Custom scripts -->
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