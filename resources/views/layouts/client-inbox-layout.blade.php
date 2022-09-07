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

                    <ul class="messages-list">
                        @foreach ($conversation_subscriptions as $item)
                            <li class="unread">
                                <a href="page-inbox-message.html">
                                    <div class="header">
                                        <span class="action"><i class="fa fa-square-o"></i><i class="fa fa-square"></i></span> 
                                        <span class="from">{{ $item->conversation->other_client->name }}</span>
                                        <span class="date"><span class="fa fa-paper-clip"></span> {{ $item->conversation->latest_message->created_at->format('M d, Y, g:i A') }}</span>
                                    </div>
                                    <div class="title">
                                        <span class="action"><i class="fa fa-star-o"></i><i class="fa fa-star bg"></i></span>
                                        {{ $item->conversation->subject }}
                                    </div>	
                                    <div class="description">
                                        {!! $item->conversation->latest_message->content_text !!}
                                    </div>
                                </a>		
                            </li>
                        @endforeach
                    </ul>
                    
                </div>	
                
            </div>	

            
        </div><!--/.col-->	
                
    </div>
</div>


@include('client.includes.set_company_modal')
@include('client.conversations.includes.create_conversation_modal')
@endsection

@section('script')
<script>
$(document).ready(function() {
    
});
</script>
@endsection