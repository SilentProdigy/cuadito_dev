<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cuadito') }} | Billing</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ App::environment('local') ? asset('images/logo/logo.png') : secure_asset('images/logo/favicon.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <script src="https://kit.fontawesome.com/7a6e9affc7.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css"
    rel="stylesheet"
    />
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/mdb.min.js') }}" defer></script>

    @yield('style')

</head>

<body>
    <main style="margin-top: 58px;">
        <div class="container px-5">
            <section>
                <div class="container py-5">
                    <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center pb-5">
                        <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
                            <div class="py-4 d-flex flex-row">
                                <h5><span class="far fa-check-square pe-2"></span><b>DragonPay</b> |</h5>
                                <span class="ps-2">Payment Gateway</span>
                            </div>
                            <h4 class="text-success">@money($subscription_type->amount)</h4>
                            <h4>{{ $subscription_type->name }}</h4>
                            <!-- <div class="d-flex pt-2">
                                <div>
                                    <p>
                                    <b>Insurance Responsibility <span class="text-success">$71.76</span></b>
                                    </p>
                                </div>
                                <div class="ms-auto">
                                    <p class="text-primary">
                                    <i class="fas fa-plus-circle text-primary pe-1"></i>Add insurance card
                                    </p>
                                </div>
                            </div> -->
                            <!-- <p>
                            Insurance claims and all necessary dependencies will be submitted to your
                            insurer for the coverred portion of this order
                            </p> -->
                            <!-- <div class="rounded d-flex" style="background-color: #f8f9fa;">
                            <div class="p-2">Aetna-Open Access</div>
                            <div class="ms-auto p-2">OAP</div>
                            </div> -->
                            <hr />
                            <div class="pt-2">
                            <div class="d-flex pb-2">
                                <div class="ms-auto">
                                <p class="text-primary">
                                    <i class="fas fa-plus-circle text-primary pe-1"></i>Add payment card
                                </p>
                                </div>
                            </div>
                            <p>
                                This is an estimate for the portion of your order (not covered by
                                insurance) due today . once insurance finalizes their review refunds
                                and/or balances will reconcile automatically.
                            </p>
                            <form id="checkout-form" action="{{ route('client.subscriptions.subscribe', $subscription_type) }}" method="POST" class="pb-3">
                                @csrf
                                <div class="d-flex flex-row pb-3">
                                <div class="d-flex align-items-center pe-2">
                                    <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1"
                                    value="" aria-label="..." checked />
                                </div>
                                <div class="rounded border d-flex w-100 p-3 align-items-center">
                                    <p class="mb-0">
                                    <i class="fab fa-cc-visa fa-lg text-black pe-2"></i>Visa Debit
                                    Card
                                    </p>
                                    <div class="ms-auto">************3456</div>
                                </div>
                                </div>

                                <div class="d-flex flex-row pb-3">
                                    <div class="d-flex align-items-center pe-2">
                                        <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2"
                                        value="" aria-label="..." />
                                    </div>
                                    <div class="rounded border d-flex w-100 p-3 align-items-center">
                                        <p class="mb-0">
                                        <i class="fab fa-cc-mastercard fa-lg text-dark pe-2"></i>Mastercard
                                        Office
                                        </p>
                                        <div class="ms-auto">************1038</div>
                                    </div>
                                </div>

                                <div class="d-flex flex-row">
                                    <div class="d-flex align-items-center pe-2">
                                        <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel3"
                                        value="" aria-label="..." />
                                    </div>
                                    <div class="rounded border d-flex w-100 p-3 align-items-center">
                                        <p class="mb-0">
                                        <i class="fas fa-credit-card fa-lg text-dark pe-2"></i>Gcash Mastercard
                                        </p>
                                        <div class="ms-auto">************7887</div>
                                    </div>
                                </div>
                            </form>
                            <a href="javascript::void()" class="btn btn-orange btn-block btn-lg" onclick="document.getElementById('checkout-form').submit()">Proceed To Checkout</a>
                            <!-- <input type="button" value="Proceed to payment" class="btn btn-orange btn-block btn-lg" /> -->
                            </div>
                        </div>

                        <div class="col-md-5 col-xl-4 offset-xl-1">
                            <div class="py-4 d-flex justify-content-end">
                            <h6><a href="{{ url()->previous() }}" class="text-orange">Cancel and return to website</a></h6>
                            </div>
                            <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa;">
                            <div class="p-2 me-3">
                                <h4>Order Recap</h4>
                            </div>
                            <div class="p-2 d-flex">
                                <div class="col-8">Package Detail</div>
                                <div class="ms-auto">@money(00.00)</div>
                            </div>
                            <div class="p-2 d-flex">
                            <div class="col-8">Package Detail</div>
                                <div class="ms-auto">@money(00.00)</div>
                            </div>
                            <div class="p-2 d-flex">
                            <div class="col-8">Package Detail</div>
                                <div class="ms-auto">@money(00.00)</div>
                            </div>
                            <div class="p-2 d-flex">
                            <div class="col-8">Package Detail</div>
                                <div class="ms-auto">@money(00.00)</div>
                            </div>
                            <div class="border-top px-2 mx-2"></div>
                            <div class="p-2 d-flex pt-3">
                            <div class="col-8">Package Detail</div>
                                <div class="ms-auto">@money(00.00)</div>
                            </div>
                            <div class="p-2 d-flex">
                            <div class="col-8">Package Detail</div>
                                <div class="ms-auto">@money(00.00)</div>
                            </div>
                            <div class="border-top px-2 mx-2"></div>
                            <div class="p-2 d-flex pt-3">
                                <div class="col-8">Package Detail</div>
                                <div class="ms-auto">@money(00.00)</div>
                            </div>
                            <div class="p-2 d-flex">
                                <div class="col-8">Package Detail</div>
                                <div class="ms-auto">@money(00.00)</div>
                            </div>
                            <div class="border-top px-2 mx-2"></div>
                            <div class="p-2 d-flex pt-3">
                                <div class="col-8"><b>Total</b></div>
                                <div class="ms-auto"><b class="text-success">@money($subscription_type->amount)</b></div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
<!-- MDB -->
<script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"
    ></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @yield('script')
    <script>
        $(document).ready(function(){
        $("#subscriptionModal").modal('show');
    });
    </script>
</body>

</html>

    <!-- <div class="container px-5">
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
                                <form id="checkout-form" action="{{ route('client.subscriptions.subscribe', $subscription_type) }}" method="POST">
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

    </div> -->

