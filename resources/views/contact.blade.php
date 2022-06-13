@extends('layouts.app')

@section('content')
<div class="container contact">
    @if (session('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
    @endif
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <form method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-6">
                <div>
                    <h3>Customer Service</h3>
                    1300 06 06 01
                    <h3 class="mt-3">Head Office</h3>
                    2 George st,<br>
                    Sydenham, New South Wales 2044</br>
                    Australia
                </div>
                <div class="mt-3">
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe width="100%" height="400" frameborder="0" style="border: 0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA__6JEwxSPmxQTDsG4k8KRKzQry-dHW60&amp;q=2+George+st%2c%2c+Sydenham%2c+New+South+Wales%2c+2044%2c+Australia" allowfullscreen="">
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <h2>Contact Us</h2>
                <div>Name</div>
                <div><input type="text" class="form-control" name="name" required></div>
                <div>Email</div>
                <div><input type="email" class="form-control" name="email" required></div>
                <div>Phone NO</div>
                <div><input type="text" class="form-control" name="phone" required></div>
                <div>Order NO</div>
                <div><input type="number" class="form-control" name="order_id" placeholder="If applicable"></div>
                <div>Message</div>
                <div><textarea name="message" class="form-control" rows="10" required></textarea></div>
                <div class="mt-3"><button type="submit" name="submit" value="send" class="btn btn-primary w-100">Send</div>

                <div class="col-6">

                </div>
            </div>
        </div>
    </form>
    @endsection