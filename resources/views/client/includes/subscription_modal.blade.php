<div class="modal fade" id="subscriptionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> -->
        <div class="modal-body p-5">
          <button type="button" class="btn-close" style="float:right" data-bs-dismiss="modal" aria-label="Close"></button>
            <section class="pricing-section">
              <div class="container">
              <div class="row justify-content-md-center">
                <div class="col-xl-5 col-lg-6 col-md-8">
                  <div class="section-title text-center title-ex1">
                    <h2>Get connected to other businesses around the Philippines</h2>
                  </div>
                </div>
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
                @endforeach
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>