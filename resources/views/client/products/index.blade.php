@extends('layouts.client-main-layout')

@section('content')    
    <h1 class="my-2">Pricing</h1>
      <section class="pricing-section">
          <div class="container">
          <div class="row justify-content-md-center">
          </div>
          <!-- Pricing Table starts -->
          <div class="row">
            @foreach ($products as $item)
            <div class="col-md-4">
              <div class="price-card">
                <h2>{{ $item->name }}</h2>
                <p>* All packages are billed annually.</p>
                <p class="price"><span>{{$item->amount}}</span>/ mo.</p>
                <p>&#8369;&nbsp;{{number_format($item->amount * 12, 2, '.', ','); }}&nbsp;/ year</p>
                <ul class="pricing-offers">
                  <li>{{$item->max_proposals_count}} Proposals</li>
                  <li>{{$item->max_projects_count}} Projects</li>
                </ul>
                @if($latest_subscription && $latest_subscription->subscription_type_id == $item->id)
                  <a href="{{ route('client.subscriptions.unsubscribe', $latest_subscription) }}" class="subscription_btn btn btn-danger">Unsubscribe</a>
                @else 
                  <a href="{{ route('client.billings.create', $item) }}" class="subscription_btn btn btn-orange">Subscribe Now</a>    
                @endif
                <!-- <a href="{{ route('client.billings.create', $item) }}" class="btn btn-primary btn-mid">Subscribe Now</a> -->
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </section>
    <!-- <div class="pricing-area">
      <div class="container">
        <div class="row">
        @foreach ($products as $item)
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="single-price">
              <div class="deal-top">
                <h3>{{ $item->name }}</h3>
                <h4> @money($item->amount)</h4> 
              </div>
              <div class="deal-bottom">
                <div class="btn-area">
                  @if($latest_subscription && $latest_subscription->subscription_type_id == $item->id)
                    <a href="{{ route('client.subscriptions.unsubscribe', $latest_subscription) }}" class="btn btn-danger">Unsubscribe</a>
                  @else 
                    <a href="{{ route('client.billings.create', $item) }}">Subscribe Now</a>    
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach 
        </div>
      </div>
    </div> -->
@endsection
