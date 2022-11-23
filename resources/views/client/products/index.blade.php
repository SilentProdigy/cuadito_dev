@extends('layouts.client-main-layout')

@section('content')    
    <h1 class="my-2">Our Products</h1>

    <div class="row">    
        @foreach ($products as $item)
            <div class="col-sm-4">
                <h3>{{ $item->name }} - @money($item->amount)</h3>
                <p>{{ $item->description }}</p>
                @if($latest_subscription && $latest_subscription->subscription_type_id == $item->id)
                    <a href="{{ route('client.subscriptions.unsubscribe', $latest_subscription) }}" class="btn btn-danger">Unsubscribe</a>
                @else 
                    <a href="{{ route('client.billings.create', $item) }}" class="btn btn-warning">Buy Now</a>
                @endif
            </div>
        @endforeach
    </div>
@endsection
