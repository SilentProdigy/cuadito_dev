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
        <a href="{{ route('client.billings.create', $item) }}">Subscribe Now</a>    
        </div>
        </div>
    </div>
    </div>
@endforeach
</div>