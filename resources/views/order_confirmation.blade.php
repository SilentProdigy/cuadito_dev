@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 shadow-sm p-5 rounded" style="background-color: #eeeeee">
            <h1><i class="text-success fa fa-check-circle"></i> Thanks!</h1>
            <h3>Your Order Number is: #{{ session('order_id') }}</h3>
            <hr />
            <div>If you have any further enquiries please contact the customer support team on 1300 06 06 01 or alex@cict.com.au.</div>
            <div>Your invoice is available <a href="/invoice?order_id={{ session('order_id') }}">here</a></div>
        </div>
    </div>
</div>
@endsection
