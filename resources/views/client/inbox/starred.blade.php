@extends('client.inbox.includes.inbox_layout')

@section('main_room_section')    

<ul class="messages-list">
    @foreach ($conversation_subscriptions as $item)
        <li class="unread">
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
    @endforeach
</ul>

@endsection

@section('script')
<script>
     $(document).ready(function() {
        let archived_buttons = document.querySelectorAll('.btn-archive');

        archived_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-subscription');   
                data = JSON.parse(data);

                let myModal = new bootstrap.Modal(document.getElementById('confirm-archived-modal'), {keyboard: false})
                myModal.show()

                // document.querySelector('#project-name').innerHTML = data.title;

                let form = document.querySelector('#archive-conversation-form');
                form.setAttribute('action', `/client/convo-subs/archive/${ data.id }`);
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
    });
</script>
@endsection