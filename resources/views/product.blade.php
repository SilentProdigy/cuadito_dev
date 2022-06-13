@extends('layouts.app')

@section('content')
<div class="container product">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row mb-3">
        <div class="col-9">
            <h2>{{ $product->name }}</h2>
            <div><b>Product ID:</b> {{ $product->id }}</div>
        </div>

        <div class="col-3">
        @guest
            <button type="button" class="btn btn-primary w-100">View Member Pricing</button>
        @else
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#searchCustomer">
                Select a Customer
            </button>

            <!-- Modal -->
            <div class="modal fade" id="searchCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select a Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="search-customer-input" name="search_customer">
                    <div id="search-customer-result"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="search-customer-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="search-customer-btn">Search</button>
                </div>
                </div>
            </div>
            </div>

        @endguest
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            <div class="product-picture"><img src="{{ $product->picture }}"></div>
        </div> 
        <div class="col-3">
            @guest
            @else
                <h1>${{ $product->price }}</h1>
            @endguest
            <h3>Availability</h3>
    
            @if ($product->quantity > 0) 
                <h5 class="availability-instock"><i class="fa-solid fa-circle-check"></i> In Stock</h5>
            @else
            <h5 class="availability-outstock"><i class="fa-solid fa-circle-check"></i> Out of Stock</h5>
            @endif
            
            <div class="mt-5">
            @guest
                <button type="button" redirect="/login" class="btn btn-success" name="submit" value="add-to-cart">Add to cart</button>
            @else
                <form method="POST">
                    @csrf <!-- {{ csrf_field() }} -->
                    <button type="submit" class="btn btn-success" name="submit" value="add-to-cart" @if ($product->quantity == 0) disabled @endif>Add to cart</button>
                    <input type="hidden" id="customer-id" name="customer-id">
                </form>
            @endguest
            </div>
        </div>
    </div>
    <div class="mt-3">{{ $product->description }}</div>
    <h3 class="mt-3">Recently Viewed</h3>
    <div class="row">
        @foreach ($viewedProducts as $key => $product)
            @if ($key < count($viewedProducts) - 6)
                @break
            @endif
            <div class="col-2">
                <div>
                    <a href="/product?id={{ $product->id }}">
                        <img src="{{ $product->picture }}" class="product-thumb">
                    </a>
                </div>
                <div>
                    <a href="/product?id={{ $product->id }}">{{ $product->name }}</a>    
                </div>
                @guest
                @else
                    <div>
                        <h4>${{ $product->price }}</h4>
                    </div>
                @endguest
            </div>
        @endforeach
    </div>
</div>
@endsection
