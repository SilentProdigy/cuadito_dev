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
                    
                    <div class="mb-3">
                        <span class="btn-group">
                            {{-- Mark as unread --}}
                            <a href="{{ route('client.conversation-subs.unread', $subscription) }}" class="btn btn-default btn-unread">
                                <span class="fa fa-envelope"></span>
                            </a>
                            
                            @if(!$subscription->is_starred)
                                <button class="btn btn-default btn-star" data-subscription="{{ json_encode($subscription) }}">
                                    <span class="fa fa-star"></span>
                                </button>
                            @else
                                <button class="btn btn-default btn-unstar" data-subscription="{{ json_encode($subscription) }}">
                                    <span class="fa fa-star-o"></span>
                                </button>
                            @endif
                            
                            @if(!$subscription->is_archived)
                                <button class="btn btn-default btn-archive" data-subscription="{{ json_encode($subscription) }}">
                                    <span class="fa fa-archive"></span>
                                </button>
                            @else 
                                <button class="btn btn-default btn-unarchive" data-subscription="{{ json_encode($subscription) }}">
                                    <span class="fa fa-box-open"></span>
                                </button>
                            @endif

                            @if(!$subscription->is_important)
                                <button class="btn btn-default btn-important" data-subscription="{{ json_encode($subscription) }}">
                                    <span class="fa fa-bookmark-o"></span>
                                </button>
                            @else 
                                <button class="btn btn-default btn-unimportant" data-subscription="{{ json_encode($subscription) }}">
                                    <span class="fa fa-bookmark"></span>
                                </button>
                            @endif
                        </span>
                    
                        {{-- 
                            <span class="btn-group">
                                <button class="btn btn-default"><span class="fa fa-mail-reply"></span></button>
                                <button class="btn btn-default"><span class="fa fa-mail-reply-all"></span></button>
                                <button class="btn btn-default"><span class="fa fa-mail-forward"></span></button>
                            </span>
                        --}}
                        
                        <button class="btn btn-default btn-delete" data-subscription="{{ json_encode($subscription) }}"><span class="fa fa-trash-o"></span></button>
                    
                        <span class="btn-group">
                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="fa fa-tags"></span> <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">add label <span class="label label-danger"> Home</span></a></li>
                                <li><a href="#">add label <span class="label label-info">Job</span></a></li>
                                <li><a href="#">add label <span class="label label-success">Clients</span></a></li>
                                <li><a href="#">add label <span class="label label-warning">News</span></a></li>
                            </ul>
                        </span> 
                    
                        <span class="btn-group pull-right">
                            <button class="btn btn-default"><span class="fa fa-chevron-left"></span></button>
                            <button class="btn btn-default"><span class="fa fa-chevron-right"></span></button>
                        </span>
                    </div>

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

<form action="#" id="star-form" method="POST">
    @csrf
    <input type="hidden" name="star" value="true" id="star-txt">
</form>

<form action="#" id="important-form" method="POST">
    @csrf
    <input type="hidden" name="important" value="true" id="important-txt">
</form>

@include('client.includes.set_company_modal')
@include('client.conversations.includes.create_conversation_modal')
@include('client.conversations.includes.confirm_archived_modal')
@include('client.conversations.includes.confirm_delete_modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {

        let important_buttons = document.querySelectorAll('.btn-important');
        important_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-subscription');   
                data = JSON.parse(data);

                document.querySelector('#important-txt').value = 'true';
                let form = document.querySelector('#important-form');
                form.setAttribute('action', `/client/convo-subs/important/${ data.id }`);
                form.submit();
            });
        });

        let unimportant_buttons = document.querySelectorAll('.btn-unimportant');
        unimportant_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-subscription');   
                data = JSON.parse(data);

                document.querySelector('#important-txt').value = 'false';
                let form = document.querySelector('#important-form');
                form.setAttribute('action', `/client/convo-subs/important/${ data.id }`);
                form.submit();
            });
        });


        let archived_buttons = document.querySelectorAll('.btn-archive');
        archived_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-subscription');   
                data = JSON.parse(data);
                let myModal = new bootstrap.Modal(document.getElementById('confirm-archived-modal'), {keyboard: false})
                myModal.show()
                // document.querySelector('#project-name').innerHTML = data.title;
                let form = document.querySelector('#archive-form');
                form.setAttribute('action', `/client/convo-subs/archive/${ data.id }`);
                document.querySelector('#archived-txt').value = 'true';
            });
        });

        let unarchived_buttons = document.querySelectorAll('.btn-unarchive');
        unarchived_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-subscription');   
                data = JSON.parse(data);
                // document.querySelector('#project-name').innerHTML = data.title;
                let form = document.querySelector('#archive-form');
                form.setAttribute('action', `/client/convo-subs/archive/${ data.id }`);
                document.querySelector('#archived-txt').value = 'false';
                form.submit();
            });
        });

        let star_buttons = document.querySelectorAll('.btn-star');
        star_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-subscription');   
                data = JSON.parse(data);

                let form = document.querySelector('#star-form');
                document.querySelector('#star-txt').value = true;
                form.setAttribute('action', `/client/convo-subs/star/${ data.id }`);
                form.submit();
            });
        });

        let unstar_buttons = document.querySelectorAll('.btn-unstar');
        unstar_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-subscription');   
                data = JSON.parse(data);
                let form = document.querySelector('#star-form');
                document.querySelector('#star-txt').value = false;
                form.setAttribute('action', `/client/convo-subs/star/${ data.id }`);
                form.submit();
            });
        });

        let delete_buttons = document.querySelectorAll('.btn-delete');
        delete_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-subscription');   
                data = JSON.parse(data);
                let myModal = new bootstrap.Modal(document.getElementById('confirm-delete-conversation-modal'), {keyboard: false})
                myModal.show()
                // document.querySelector('#project-name').innerHTML = data.title;
                let form = document.querySelector('#delete-conversation-form');
                form.setAttribute('action', `/client/convo-subs/delete/${ data.id }`);
            });
        });
    });
</script>
@endsection