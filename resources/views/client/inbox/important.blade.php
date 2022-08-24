@extends('client.inbox.includes.inbox_layout')

@section('style')
    <style>
        .read {
            background-color: darkgray;
        }
    </style>
@endsection

@section('main_room_section')
    <ul class="messages-list">
        @forelse ($conversation_subscriptions as $item)
            <li class="{{ $item->have_unread_messages ? 'read' : 'unread' }}">
                <a href="{{ route('client.conversations.show', $item->conversation) }}">
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
        @empty
            <li>
                <p>No Messages Tag as Important Here!</p>
            </li>
        @endforelse
    </ul>
@endsection