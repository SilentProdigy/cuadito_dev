@extends('layouts.client-main-layout')

@section('content')    
<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">{{ $conversation->subject }}</div>
        <div class="col d-flex justify-content-end">
            
        </div>
    </div>
</div>

@foreach ($messages as $message)
    <div class="card my-3">
        <div class="card-header">
            <p>{{ $message->sender->name }}</p>
        </div>
        <div class="card-body">
            <p>{{ $message->content }}</p>
        </div>
        <div class="card-footer">
            <p>{{ $message->created_at->format('M d,Y') }}</p>
        </div>
    </div>    
@endforeach

<div class="card my-3">
    <div class="card-body">
        <form action="{{ route('client.messages.store', $conversation) }}" method="POST">
            @csrf
            <textarea name="content" rows="5" class="form-control"></textarea><br>
            <input type="submit" value="Send">
        </form>
    </div>
</div>
@endsection

@section('script')
   
@endsection