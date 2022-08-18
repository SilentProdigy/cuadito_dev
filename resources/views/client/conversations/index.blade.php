@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Inbox</div>
        <div class="col d-flex justify-content-end">
            <button class="btn btn-warning header-btn" data-bs-toggle="modal" data-bs-target="#create-new-conversation-modal">
                <i class="fa fa-plus"></i>&ensp;New Email
            </button>
        </div>
    </div>
</div>

@forelse ($conversation_subscriptions as $item)
    <section class="border p-4 border-2 rounded my-2">
        <div>
            <div class="d-flex justify-content-between align-content-center">
                <div class="fs-5 fw-bold">
                    @if( $item->is_starred )
                    <a href="#" class="text-warning btn-unstar" data-subscription="{{ json_encode($item) }}"><i class="fa fa-star fa-star"></i></a> 
                    @endif 
                    
                    {{ $item->conversation->other_client->name }}
                </div>
                <p class="fs-5 fw-bold">{{ $item->conversation->latest_message->created_at->format('M d, Y') }}</p>
            </div>

            <p class="fs-6 fw-bold">{{ $item->conversation->subject }}</p>
        </div>

        <div>
            <p class="fs-6 fw-light">
                {{ $item->conversation->latest_message->content }}
            </p>	
    
        </div>

        <div class="d-flex justify-content-end align-content-center">
            <a href="{{ route('client.conversations.show', $item->conversation) }}" class="text-info p-1">
                <i class="fa fa-eye"></i>
            </a>
            <a href="javascript::void()" class="text-dark p-1 btn-archive" data-subscription="{{ json_encode($item) }}">
                <i class="fa fa-archive"></i>
            </a>
            @if(!$item->is_sta)
                <a href="#" class="text-warning p-1 btn-star" data-subscription="{{ json_encode($item) }}">
                    <i class="fa fa-star"></i>
                </a>
            @endif
            <a href="#" class="text-danger p-1 btn-delete" data-subscription="{{ json_encode($item) }}">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </section>

    <form action="#" id="star-form" method="POST">
        @csrf
        <input type="hidden" name="star" value="true" id="star-txt">
    </form>

    <section class="mt-3 d-flex justify-content-center">
        {{-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav> --}}
            
        {{ $conversation_subscriptions->links() }}
    </section>
@empty
    <section class="border p-4 border-2 rounded my-2">
        <p class="fs-4">You don't have any messages in your Inbox!</p>
    </section>
@endforelse




@include('client.conversations.includes.create_conversation_modal')
@include('client.conversations.includes.confirm_archived_modal')
@include('client.conversations.includes.confirm_delete_modal')
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