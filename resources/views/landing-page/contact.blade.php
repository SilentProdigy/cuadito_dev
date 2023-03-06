@extends('landing-page.landing-page-layout')
@section('styles')
<style>
#contact-page{
    margin: 10% 0%;
}
#contact-page .banner-cuadito{
    background-color: #F96B23;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='50%25' viewBox='0 0 1600 800'%3E%3Cg %3E%3Cpath fill='%23fa894f' d='M486 705.8c-109.3-21.8-223.4-32.2-335.3-19.4C99.5 692.1 49 703 0 719.8V800h843.8c-115.9-33.2-230.8-68.1-347.6-92.2C492.8 707.1 489.4 706.5 486 705.8z'/%3E%3Cpath fill='%23fba67b' d='M1600 0H0v719.8c49-16.8 99.5-27.8 150.7-33.5c111.9-12.7 226-2.4 335.3 19.4c3.4 0.7 6.8 1.4 10.2 2c116.8 24 231.7 59 347.6 92.2H1600V0z'/%3E%3Cpath fill='%23fdc4a7' d='M478.4 581c3.2 0.8 6.4 1.7 9.5 2.5c196.2 52.5 388.7 133.5 593.5 176.6c174.2 36.6 349.5 29.2 518.6-10.2V0H0v574.9c52.3-17.6 106.5-27.7 161.1-30.9C268.4 537.4 375.7 554.2 478.4 581z'/%3E%3Cpath fill='%23fee1d3' d='M0 0v429.4c55.6-18.4 113.5-27.3 171.4-27.7c102.8-0.8 203.2 22.7 299.3 54.5c3 1 5.9 2 8.9 3c183.6 62 365.7 146.1 562.4 192.1c186.7 43.7 376.3 34.4 557.9-12.6V0H0z'/%3E%3Cpath fill='%23FFFFFF' d='M181.8 259.4c98.2 6 191.9 35.2 281.3 72.1c2.8 1.1 5.5 2.3 8.3 3.4c171 71.6 342.7 158.5 531.3 207.7c198.8 51.8 403.4 40.8 597.3-14.8V0H0v283.2C59 263.6 120.6 255.7 181.8 259.4z'/%3E%3Cpath fill='%23ffffff' d='M1600 0H0v136.3c62.3-20.9 127.7-27.5 192.2-19.2c93.6 12.1 180.5 47.7 263.3 89.6c2.6 1.3 5.1 2.6 7.7 3.9c158.4 81.1 319.7 170.9 500.3 223.2c210.5 61 430.8 49 636.6-16.6V0z'/%3E%3Cpath fill='%23ffffff' d='M454.9 86.3C600.7 177 751.6 269.3 924.1 325c208.6 67.4 431.3 60.8 637.9-5.3c12.8-4.1 25.4-8.4 38.1-12.9V0H288.1c56 21.3 108.7 50.6 159.7 82C450.2 83.4 452.5 84.9 454.9 86.3z'/%3E%3Cpath fill='%23ffffff' d='M1600 0H498c118.1 85.8 243.5 164.5 386.8 216.2c191.8 69.2 400 74.7 595 21.1c40.8-11.2 81.1-25.2 120.3-41.7V0z'/%3E%3Cpath fill='%23ffffff' d='M1397.5 154.8c47.2-10.6 93.6-25.3 138.6-43.8c21.7-8.9 43-18.8 63.9-29.5V0H643.4c62.9 41.7 129.7 78.2 202.1 107.4C1020.4 178.1 1214.2 196.1 1397.5 154.8z'/%3E%3Cpath fill='%23FFFFFF' d='M1315.3 72.4c75.3-12.6 148.9-37.1 216.8-72.4h-723C966.8 71 1144.7 101 1315.3 72.4z'/%3E%3C/g%3E%3C/svg%3E");
    background-size: cover;
    max-width: 100%;
    padding-bottom: 10%;
}
</style>
@endsection
@section('content')
<div id="contact-page">
    <div class="container-fluid d-flex justify-content-center align-items-center banner-cuadito">
        <div class="row smooth-scroll">
          <div class="col-md-6">
            <img class="img-fluid w-100" src="{{ asset('images/elements/communication.png') }}">
          </div>
          <div class="col-md-6 p-5 d-flex justify-content-center align-items-center ">
            <div class="wow fadeInDown">
                <h1 class="display-3 text-uppercase fw-bold">Contact us</h1>
                
                <h5 class="fw-normal">We are gladly answer any of your questions with regards to our platform and how to get started.</h5>
            </div>
            <!-- <a href="{{ route('client.auth.show-register-form') }}" class="btn landing-page-btn btn-rounded mt-5 fs-5">Get Started <i class="fa fa-angle-right"></i> </a> -->
          </div>
        </div>
    </div>

    <div class="container-fluid get-started-section">
        <div class="row">
            <div class="col-md-6 col-xl-6 mt-5 p-5">
                <h1 class="text-center display-3">GET STARTED</h1>
                <!-- <h5 class="fw-normal text-center">Sign up now to get started with our new and amazing platform.</h5> -->
                <h5 class="fw-normal text-center">Our sales representative will reach you out and schedule you to get started.</h5>
                <div class="contact-form p-5">
                    <form name="lead_form" id="lead_form" method="POST" action="javascript:void(0)">
                        @csrf
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                          <input type="text" name="name" id="name" class="form-control" />
                          <label class="form-label" for="name">Name</label>
                        </div>
                      
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                          <input type="email" id="email" name="email" class="form-control" />
                          <label class="form-label" for="email">Email address</label>
                        </div>

                        <!-- Phone Number input -->
                        <div class="form-outline mb-4">
                            <input type="tel" id="number" name="number" class="form-control" />
                            <label class="form-label" for="number">Phone Number</label>
                        </div>

                        <!-- Company Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="company" name="company" class="form-control" />
                            <label class="form-label" for="company">Company Name</label>
                        </div>

                        <!-- Company Segment input -->
                        <!-- <select class="form-select mb-4" aria-label="Segment" required>
                            <option selected>Select your segment</option>
                            <option value="1">Enterprise</option>
                            <option value="2">Jumpstart</option>
                            <option value="3">Emerge</option>
                        </select> -->
                      
                        <!-- Message input -->
                        <div class="form-outline mb-4">
                          <textarea class="form-control" name="message" id="message" rows="4"></textarea>
                          <label class="form-label" for="message">Message</label>
                        </div>
                      
                        <!-- Checkbox -->
                        <div class="form-check d-flex justify-content-center mb-4">
                          <input class="form-check-input me-2" type="checkbox" value="" id="contact-copy" />
                          <label class="form-check-label" for="contact-copy">
                            Send me a copy of this message
                          </label>
                        </div>

                        <!-- Channel -->
                        <input type="hidden" id="channel" value="Cuadito Website" name="channel" />
                      
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-orange btn-block mb-4">Send</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/elements/form.png') }}"
                      class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 bg-light connection-section">
        <div class="container">

            <h3 class="display-6 text-center text-uppercase mt-4">Make meaningful connections - join our trusted partners today!</h3>
            <div class="row pt-4 cuadito-logos">
                <div class="col-lg-3 col-md-3 col-6">
                    <img class="img-fluid mx-auto d-block" src="{{asset('images/company_logo/1mc-logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy">
                </div>
                <div class="col-lg-3 col-md-3 col-6">
                    <img class="img-fluid mx-auto d-block" src="{{asset('images/company_logo/amti-logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy">
                </div>
                <div class="col-lg-3 col-md-3 col-6">
                    <img class="img-fluid mx-auto d-block" src="{{asset('images/company_logo/amarantos-logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy">
                </div>
                <div class="col-lg-3 col-md-3 col-6">
                    <img class="img-fluid mx-auto d-block" src="{{asset('images/company_logo/rz-studios-logo.webp')}}" height="100" alt="Cuadito Logo" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    if ($("#lead_form").length > 0) {
        $("#lead_form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50
                },
                email: {
                    required: true,
                    maxlength: 50,
                    email: true,
                },  
                company: {
                    required: true,
                    maxlength: 50
                },   
            },
            messages: {
                name: {
                    required: "Please enter name",
                    maxlength: "Your name max length should be 50 characters long."
                    },
                email: {
                    required: "Please enter valid email",
                    email: "Please enter valid email",
                    maxlength: "The email name should less than or equal to 50 characters",
                },   
                company: {
                    required: "Please enter company name",
                    maxlength: "Your company name max length should be 50 characters long."
                },
            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#submit').html('Please Wait...');
                $("#submit").attr("disabled", true);
                
                $.ajax({
                    url: "{{route('store-data')}}",
                    type: "POST",
                    data: $('#lead_form').serialize(),
                    success: function( response ) {
                        $('#submit').html('Submit');
                        $("#submit"). attr("disabled", false);
                        alert('Ajax form has been submitted successfully');
                        document.getElementById("lead_form").reset(); 
                    }
                });
            }
        })
    }
    </script>
@endsection