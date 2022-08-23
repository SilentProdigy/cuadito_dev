@extends('layouts.client-main-layout')

@section('content')
<div class="container px-5">
    <div class="row inbox">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body inbox-menu">
                    <button class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#create-new-conversation-modal">New Email</button>
                    @include('client.inbox.includes.rooms_links')
                    @include('client.inbox.includes.labels_links')
                </div>	
            </div>
            @include('client.inbox.includes.contact_list')
        </div><!--/.col-->
        
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    @include('client.inbox.includes.email_actions')

                    <h4>{{ $conversation->subject }}</h4>

                    @foreach ($messages as $message)
                        <section class="border p-4 border-2 rounded my-2">
                            <div>
                                <div class="d-flex justify-content-between align-content-center">
                                    <div class="fs-6 fw-bold">    
                                        {{ $message->sender->name }}
                                    </div>
                                    <p class="fs-6 fw-bold">{{ $message->created_at->format('M d, Y') }}</p>
                                </div>

                                <div>
                                    <p class="fs-6 fw-light">{{ $message->content }}</p>	
                                </div>
                            </div>
                        </section>
                    @endforeach
                </div>	

                <div class="my-3 p-2 border">
                    <h6 class="my-3">Reply:</h6>
                    <form action="{{ route('client.messages.store', $conversation) }}" method="POST">
                        @csrf
                        <textarea name="content" rows="5" class="form-control border border-3 border-dark  @error('content') is-invalid @enderror" placeholder="Enter message here ..."></textarea><br>
                        <input type="submit" value="Send Message" class="btn btn-primary my-2">
                    </form>
                </div>
                
                
            </div>	

            
        </div><!--/.col-->	
                
    </div>
</div>


@include('client.includes.set_company_modal')
@include('client.conversations.includes.create_conversation_modal')
@endsection

@section('script')

@endsection