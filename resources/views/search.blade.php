@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Results</h1>

    <div class="container">
        <div class="row">
            @forelse ($products as $product)
            <div class="col-2 mb-5">
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
                <h3>${{ $product->price }}</h3>
                @endguest
            </div>
            @empty
            <div class="col-12">
                Could not find any products
            </div>
            @endforelse
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {!! $products->links() !!}
    </div>
</div>
@endsection