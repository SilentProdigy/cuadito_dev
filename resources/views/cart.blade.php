@extends('layouts.app')

@section('content')
<form method="POST">
@csrf <!-- {{ csrf_field() }} -->
<div class="container cart">
    @if (session('error'))
        <div class="alert alert-danger">
            {!! session('error') !!}
        </div>
    @endif
    <h1>Shopping Cart</h1>
    <div class="row">
        <div class="col-9">
            @forelse ($cartItems as $cartItem)
                <div class="row cart-item align-items-center">
                    <div class="col-1"><img src="{{ $cartItem->picture}}" class="w-100"></div>
                    <div class="col-6">
                        <div><b>{{ $cartItem->name }}</b></div>
                        <div class="price">${{ $cartItem->price }}</div>
                    </div>
                    <div class="col-1">Quantity</div>
                    <div class="col-2">
                        <div><input type="number" min="0" name="quantity[{{ $cartItem->id }}]" class="form-control text-center" value="{{ $cartItem->quantity }}"></div>
                    </div>
                    <div class="col-1">
                        <div align="right"><b>${{ $cartItem->total }}</b></div>
                    </div>
                    <div class="col-1" align="right">
                        <input type="submit" class="btn btn-danger" name="remove[{{ $cartItem->id }}]" value="X">
                    </div>
                </div>
            @empty
                <div class="text-center"><h3 style="color: gray">Your cart is empty</h3></div>
            @endforelse
        </div>
        <div class="col-3 order-summary shadow-sm">
            <div class="text-center"><h3>Order Summary</h3></div>
            <div class="row">
                <div class="col-6">Subtotal</div>
                <div class="col-6" align="right">${{ $totalAmount }}</div>
            </div>
            <div class="row">
                <div class="col-6">Shipping</div>
                <div class="col-6" align="right">$10</div>
            </div>
            <div class="row">
                <div class="col-6">Tax</div>
                <div class="col-6" align="right">$0</div>
            </div>
            <div class="row">
                <div class="col-6">Total</div>
                <div class="col-6" align="right"><b>${{ $totalAmount }}</b></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-secondary w-100" name="submit" value="save" @if (empty($cartItems)) disabled @endif>UPDATE</button>
                    <div class="text-center">OR</div>
                    <button type="submit" class="btn btn-primary w-100" name="submit" value="checkout" @if (empty($cartItems)) disabled @endif>CONTINUE TO CHECKOUT</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
