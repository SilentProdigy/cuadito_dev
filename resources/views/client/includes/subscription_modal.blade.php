<div class="modal fade" id="subscriptionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> -->
        <div class="modal-body p-5">
          @isset($latest_subscription)
            <button type="button" class="btn-close" style="float:right" data-bs-dismiss="modal" aria-label="Close"></button>  
          @endisset
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
                        <p>The standard version</p>
                        <p class="price"><span>{{$item->amount}}</span>/ mo.</p>
                        
                        <ul class="pricing-offers">
                          <li>6 Domain Names</li>
                          <li>8 E-Mail Address</li>
                          <li>10GB Disk Space</li>
                          <li>Monthly Bandwidth</li>
                          <li>Powerful Admin Panel</li>
                        </ul>
                        
                        @if(auth('client')->user()->have_subscription && 
                            auth('client')->user()->active_subscription?->subscription_type_id == $item->id)
                          <a href="{{ route('client.subscriptions.unsubscribe', auth('client')->user()->active_subscription) }}" class="subscription_btn btn btn-danger">Unsubscribe</a>
                        @else 
                          <a href="{{ route('client.billings.create', $item) }}" class="subscription_btn btn btn-orange">Subscribe Now</a>    
                        @endif
                      </div>
                  </div>
                @endforeach
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>