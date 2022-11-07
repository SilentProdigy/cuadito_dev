@extends('layouts.client-main-layout')

@section('content')    

    <div class="container px-5">
        <section class="mt-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h1 class="my-2">Invoice</h1>
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Invoice ID</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment->id }}</p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Payment Date</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment->created_at->format('M d,Y') }}</p>
                            </div>

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
                                <p class="fs-6 lh-lg" style="color: #222;">@money( $payment->total_amount )</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
