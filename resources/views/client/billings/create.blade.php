@extends('layouts.client-main-layout')

@section('content')    

    <div class="container px-5">
        <section class="mt-4">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h1 class="my-2">Billing</h1>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Product</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $subscription_type->name }}</p>
                            </div>

                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Price</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">@money($subscription_type->amount)</p>
                            </div>

                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Billed Months</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">1 Month/s</p>
                            </div>

                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Total Amount</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">@money( $total_amount )</p>
                            </div>


                            {{-- <div class="my-2">
                                <p class="text-secondary fs-6">Posted at {{ $project->created_at->format('M d,Y') }}</p>
                                <p class="text-danger fs-6">Open till {{ $project->max_active_date }}</p>
                            </div>
    
                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Description</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $project->description }}</p>
                            </div>
    
                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Cost</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">@money($project->cost)</p>
                            </div>
    
                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Scope of Work</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $project->scope_of_work }}</p>
                            </div>
    
                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Terms & Conditions</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $project->terms_and_conditions }}</p>
                            </div>
    
                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Relevant Authorities</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $project->relevant_authorities }}</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="my-5 text-center">
                                <form id="checkout-form" action="{{ route('client.billings.checkout', $subscription_type) }}" method="POST">
                                    @csrf
                                </form>
                                
                                <a href="javascript::void()" class="btn btn-success" onclick="document.getElementById('checkout-form').submit()">Proceed To Checkout</a>
                                <a href="{{ route('client.products.index') }}" class="btn btn-default">Cancel</a>
                            </div>

                            {{--
    
                            @if($project->status == 'CLOSED' && $project->winningBidding)
                                <div class="my-5 text-center">
                                    <hr>
                                    <p class="fw-bold text-uppercase fs-6 text-secondary">Winning Proposal</p>
                                    <h5 class="fw-bold"><span class="fa fa-trophy"></span> {{ $project->winningBidding->company->name }}</h5>
                                    
                                    <p class="fw-bold text-uppercase fs-6 text-secondary">Rate</p>
                                    <h5 class="fw-bold">@money($project->winningBidding->rate)</h5>
                                    <p class="fw-bold text-uppercase fs-6 text-secondary">Owner</p>
                                    <h5 class="fw-bold">{{ $project->winningBidding->company->client->name }}</h5>
    
                                    <p class="fw-bold text-uppercase fs-6 text-secondary">#Proposal ID</p>
                                    
                                    <a href="{{ route('client.proposals.show',$project->winningBidding) }}">
                                        <h5 class="fw-bold">{{ $project->winningBidding->id }}</h5>
                                    </a>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
