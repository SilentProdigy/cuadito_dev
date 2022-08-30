@extends('client.inbox.includes.inbox_layout')

@section('main_room_section')

    {{-- {{ request()->route()->getName() == 'client.inbox.archived' ? 'hehe' : 'haha' }} --}}
    <ul class="messages-list">
        @forelse ($conversation_subscriptions as $item)
            <li class="{{ $item->conversation->have_unread_messages ? 'unread' : 'read'}}">
                <a href="{{ route('client.conversations.show', $item->conversation) }}">
                    <div class="header">
                        <span class="action">
                            <input type="checkbox" class="select-sub-checkbox" data-subscription="{{ json_encode($item) }}">
                        </span> 
                        <span class="from">{{ $item->conversation->other_client->name }}</span>
                        <span class="date"><span class="fa fa-paper-clip"></span> {{ $item->conversation->latest_message->created_at->format('M d, Y, g:i A') }}</span>
                    </div>
                    <div class="title">
                        @if(!$item->is_starred)
                            <span class="action">
                                <i class="fa fa-star-o"></i>
                            </span>
                        @else 
                            <span class="action text-warning">
                                <i class="fa fa-star"></i>
                            </span>
                        @endif
                        {{ $item->conversation->subject }}
                    </div>	
                    <div class="description">
                        {!! $item->conversation->latest_message->content_text !!}
                    </div>
                </a>		
            </li>
        @empty
            <li>
                <p>No Archived Messages Here!</p>
            </li>
        @endforelse
    </ul>
@endsection