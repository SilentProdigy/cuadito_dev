@extends('layouts.dashboard-app')

@section('content')

<div class="container">
    <div class="">
        <div id="demo" class="carousel slide" data-bs-ride="carousel">


           <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <!-- <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button> -->
            </div>
    
  
            <div class="carousel-inner center slider">
                <div class="carousel-item active">
                    <img src="{{asset('images/slider/slider1.png')}}" alt="Slider1" class="d-block" style="width:100% ">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/slider/slider2.png')}}" alt="Slider2" class="d-block" style="width:100%">
                </div>
                <!-- <div class="carousel-item">
                    <img src="{{asset('images/slider/slider3.png')}}" alt="Slider3" class="d-block" style="width:100%">
                </div> -->
            </div>
  
 
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <div class="row">
    <div class="col-xl-12">
            <div class="bg-white py-4">
                <div class="row justify-content-center">
                    <div class="col">
                        <p class="mt-3 text-start ms-5">
                        <h1>Shop Now</h1><br>
                        Try our new online store, delivering to your door or pickup now available. 
                        </p>
                        <button type="button" class="btn btn-danger">Shop Now</button>
                    </div>  
                    <div class="col mt-5 me-2">
                        <img src="{{asset('images/home/Chicken_shopnow.webp')}}" alt="Chicken" style="width:380px; height:255px">
                    </div>    
                </div>
           </div>
    </div>
</div>


    <div class="bg-white py-4">
        <div class="col mt-8">
            <img src="{{asset('images/home/chicken_cat.webp')}}" alt="Chicken" style="width:250px; height:150px">
            <img src="{{asset('images/home/meat_cat.webp')}}" alt="Chicken" style="width:250px; height:150px">
            <img src="{{asset('images/home/small_cat.webp')}}" alt="Chicken" style="width:250px; height:150px">
        </div>   
        <div class="col mt-8">
            <img src="{{asset('images/home/game_cat.webp')}}" alt="Chicken" style="width:250px; height:150px">
            <img src="{{asset('images/home/food_serv_cat.webp')}}" alt="Chicken" style="width:250px; height:150px">
            <img src="{{asset('images/home/seafood_cat.webp')}}" alt="Chicken" style="width:250px; height:150px">
        </div> 
    </div>
              
    <div class="row">
    <div class="col-xl-12">
            <div class="bg-white py-4">
                <div class="row justify-content-center">
                    <div class="col">
                        <p class="mt-3 text-start ms-5">
                        <h1>FACTORY OUTLET</h1><br>
                        <h2>Wholesale Prices Direct To The Public</h2><br>
                        <h5>Monday - Thursday: 7:00am - 4:00pm</h5><br>
                        <h5> Friday: 7:00am - 5:00pm</h5><br>
                        <h5> Saturday: 7:00am - 1:00pm</h5><br>
                        <h5>Public Holidays / Sunday: Closed</h5>
                        </p>
                        <button type="button" class="btn btn-danger">Shop Now</button>
                    </div>  
                        <div class="bg-white py-4 col mt-5 me-2">
                            <img src="{{asset('images/home/factoryOutletBk.webp')}}" alt="Chicken" style="width:700px; height:440px">
                        </div>   
                </div>
           </div>
    </div>
</div>



<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('YCC Wholesale & Distribution, Quality with a difference!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
