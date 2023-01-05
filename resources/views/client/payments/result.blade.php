@extends('layouts.client-main-layout')

@section('content')    
    <div class="container px-5">
        <section class="mt-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h1 class="my-2">Payment Details</h1>
                            </div>                            
                        </div>
                        <div class="card-body">
                            
                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Transaction ID</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment->invoice_id }}</p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Reference No</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $reference_no }}</p>
                            </div>

                            {{-- <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Payment Method</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment_method }}</p>
                            </div> --}}
                            
                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Status</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $status }}</p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Created At</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment->created_at->format('M d,Y') }}</p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Payment Date</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment->paid_at?->format('M d,Y') }}</p>
                            </div>
                                
                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Product</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">
                                    {{ $payment->subscription->subscription_type->name }} Plan
                                </p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Unit Price</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">
                                    @money($payment->subscription->subscription_type->amount)
                                </p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Total Payment</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">
                                    @money($payment->subscription->subscription_type->amount)
                                </p>
                            </div>
                                
                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Discount</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">
                                    @money(0)
                                </p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">VAT</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">
                                    @money($payment->additional_vat)
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
