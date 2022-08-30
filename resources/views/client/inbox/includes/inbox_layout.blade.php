@extends('layouts.client-main-layout')

@section('style')
    <style>
        .read {
            background-color: #ecf0f1;
        }

    </style>
@endsection

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
                        @yield('main_room_section')
                    </div>	
                </div>	
            </div><!--/.col-->	
        </div>
    </div>

    <form action="{{ route('client.conversation-subs.unread') }}" method="post" id="unread-form">
        @csrf
        <input type="hidden" name="subscription_ids" id="unread-conversation-ids">
    </form>

    <form action="{{ route('client.conversation-subs.star') }}" method="post" id="star-form">
        @csrf
        <input type="hidden" name="subscription_ids" id="star-conversation-ids">
        <input type="hidden" name="star" id="star-txt">
    </form>

    <form action="{{ route('client.conversation-subs.important') }}" method="post" id="important-form">
        @csrf
        <input type="hidden" name="subscription_ids" id="important-conversation-ids">
        <input type="hidden" name="important" id="important-txt">
    </form>

    @include('client.includes.set_company_modal')
    @include('client.conversations.includes.create_conversation_modal')
    @include('client.conversations.includes.create_conversation_modal')
    @include('client.conversations.includes.confirm_archived_modal')
    @include('client.conversations.includes.confirm_delete_modal')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const checkboxes = document.querySelectorAll(".select-sub-checkbox");

            let checkedItems = [];

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", (e) => {
                    e.preventDefault;
                    let data = e.target.getAttribute('data-subscription');   
                    data = JSON.parse(data);

                    if (e.target.checked) 
                    {
                        checkedItems.push(data);
                    }
                    else 
                    {
                        let index = checkedItems.findIndex(item => item.id == data.id);
                        checkedItems = checkedItems.splice(index, 1);
                    }
                });    
            });

            let unread_button = document.querySelector('.btn-unread');

            unread_button.addEventListener('click' , () => {
                if(checkedItems.length == 0)
                    return;
                
                let targetInput = document.querySelector('#unread-conversation-ids');
                targetInput.value = checkedItems.map(item => item.id);
                
                document.querySelector('#unread-form').submit();
            });

            let star_button = document.querySelector('.btn-star');

            star_button.addEventListener('click' , () => {
                if(checkedItems.length == 0)
                    return;
                
                document.querySelector('#star-conversation-ids').value = checkedItems.map(item => item.id); 
                document.querySelector('#star-txt').value = 'true';
                document.querySelector('#star-form').submit();
            });

            let unstar_button = document.querySelector('.btn-unstar');

            unstar_button.addEventListener('click' , () => {
                if(checkedItems.length == 0)
                    return;
                
                document.querySelector('#star-conversation-ids').value = checkedItems.map(item => item.id); 
                document.querySelector('#star-txt').value = 'false';
                document.querySelector('#star-form').submit();
            });
            
            let important_button = document.querySelector('.btn-important');

            important_button.addEventListener('click' , () => {
                if(checkedItems.length == 0)
                    return;
                
                document.querySelector('#important-conversation-ids').value = checkedItems.map(item => item.id); 
                document.querySelector('#important-txt').value = 'true';
                document.querySelector('#important-form').submit();
            });

            // important_buttons.forEach(button => {
            //     button.addEventListener('click', function(e) {  
            //         e.preventDefault;
            //         let data = button.getAttribute('data-subscription');   
            //         data = JSON.parse(data);

            //         document.querySelector('#important-txt').value = 'true';
            //         let form = document.querySelector('#important-form');
            //         form.setAttribute('action', `/client/convo-subs/important/${ data.id }`);
            //         form.submit();
            //     });
            // });
        });
    </script>
@endsection