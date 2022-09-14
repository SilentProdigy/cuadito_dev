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

    <div style="display:none" data-labels="{{ json_encode( auth('client')->user()->labels ) }}" id="user-labels-div"></div>

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

    <form action="{{ route('client.conversation-subs.archive') }}" method="post" id="archive-form">
        @csrf
        <input type="hidden" name="subscription_ids" id="archive-conversation-ids">
        <input type="hidden" name="archived" id="archive-txt">
    </form>

    <form action="{{ route('client.conversation-subs.delete') }}" method="post" id="delete-convo-form">
        @csrf
        @method('DELETE')
        <input type="hidden" name="subscription_ids" id="delete-conversation-ids">
    </form>
    
    @include('client.includes.set_company_modal')
    @include('client.conversations.includes.create_conversation_modal')
    @include('client.conversations.includes.create_conversation_modal')
    @include('client.conversations.includes.confirm_archived_modal')
    @include('client.conversations.includes.confirm_delete_modal')
    @include('client.inbox.includes.create_label_modal')
    @include('client.inbox.includes.set_labels_modal')
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            let add_label_btn = document.querySelector('#add-label-btn');

            add_label_btn.addEventListener('click', function(e) {
                e.preventDefault;

                let myModal = new bootstrap.Modal(document.getElementById('add-label-modal'), {keyboard: false})
                myModal.show()
            });

            const checkboxes = document.querySelectorAll(".select-sub-checkbox");
            let checkedItems = [];

            if(!checkboxes.length) 
            {
                // Conversation show page
                let data = document.querySelector('#subscription-div').getAttribute('data-subscription');   
                data = JSON.parse(data);
                checkedItems.push(data);
            }
            else 
            {
                // Inbox rooms (multiple conversations)
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
                            checkedItems = checkedItems.filter(item => item.id != data.id);
                        }
                    });    
                });
            }
            

            let unread_button = document.querySelector('.btn-unread');

            if(unread_button)
            {
                unread_button.addEventListener('click' , () => {
                    if(checkedItems.length == 0)
                        return;
                    
                    let targetInput = document.querySelector('#unread-conversation-ids');
                    targetInput.value = checkedItems.map(item => item.id);
                    
                    document.querySelector('#unread-form').submit();
                });
            }

            let star_button = document.querySelector('.btn-star');

            if(star_button)
            {
                star_button.addEventListener('click' , () => {
                    if(checkedItems.length == 0)
                        return;
                    
                    document.querySelector('#star-conversation-ids').value = checkedItems.map(item => item.id); 
                    document.querySelector('#star-txt').value = 'true';
                    document.querySelector('#star-form').submit();
                });
            }

            let unstar_button = document.querySelector('.btn-unstar');

            if(unstar_button)
            {
                console.log('here');

                unstar_button.addEventListener('click' , () => {
                    console.log('here');

                    if(checkedItems.length == 0)
                        return;
                    
                    document.querySelector('#star-conversation-ids').value = checkedItems.map(item => item.id); 
                    document.querySelector('#star-txt').value = 'false';
                    document.querySelector('#star-form').submit();
                });
            }
            
            let important_button = document.querySelector('.btn-important');

            if(important_button) 
            {
                important_button.addEventListener('click' , () => {
                    if(checkedItems.length == 0)
                        return;
                    
                    document.querySelector('#important-conversation-ids').value = checkedItems.map(item => item.id); 
                    document.querySelector('#important-txt').value = 'true';
                    document.querySelector('#important-form').submit();
                });
            }

            let unimportant_button = document.querySelector('.btn-unimportant');

            if(unimportant_button) 
            {
                unimportant_button.addEventListener('click' , () => {
                    if(checkedItems.length == 0)
                        return;
                    
                    document.querySelector('#important-conversation-ids').value = checkedItems.map(item => item.id); 
                    document.querySelector('#important-txt').value = 'false';
                    document.querySelector('#important-form').submit();
                });
            }

            let archive_buttons = document.querySelector('.btn-archive');

            if(archive_buttons) 
            {
                archive_buttons.addEventListener('click' , () => {
                    if(checkedItems.length == 0)
                        return;
                    
                    document.querySelector('#archive-conversation-ids').value = checkedItems.map(item => item.id); 
                    document.querySelector('#archive-txt').value = 'true';
                    document.querySelector('#archive-form').submit();
                });
            }
            
            let unarchive_button = document.querySelector('.btn-unarchive');

            if(unarchive_button) 
            {
                unarchive_button.addEventListener('click' , () => {
                    if(checkedItems.length == 0)
                        return;
                    
                    document.querySelector('#archive-conversation-ids').value = checkedItems.map(item => item.id); 
                    document.querySelector('#archive-txt').value = 'false';
                    document.querySelector('#archive-form').submit();
                });
            }
            
            let delete_buttons = document.querySelector('.btn-delete');

            if(delete_buttons) 
            {
                delete_buttons.addEventListener('click' , () => {
                    if(checkedItems.length == 0)
                        return;
                    
                    document.querySelector('#delete-conversation-ids').value = checkedItems.map(item => item.id); 
                    document.querySelector('#delete-convo-form').submit();
                });
            }

            let set_label_button = document.querySelector('#btn-set-label');

            set_label_button.addEventListener('click', () => {                
                if(checkedItems.length == 0)
                    return;

                let myModal = new bootstrap.Modal(document.getElementById('set-labels-modal'), {keyboard: false})
                myModal.show()

                let data = document.querySelector('#user-labels-div').getAttribute('data-labels');   
                data = JSON.parse(data);

                let selectBox = document.querySelector('#label-select-box');

                selectBox.innerHTML = "";

                let userLabels = checkedItems.flatMap(item => {
                    return item.labels.map(item => item.id)
                });

                document.querySelector('#labels-conversation-ids').value = checkedItems.map(item => item.id); 
    
                // console.log(data);
                data.forEach(item => {
                    let option = document.createElement('option');
                    option.text = item.name; 
                    option.value = item.id;

                    if( userLabels.length > 0 && userLabels.includes( item.id )) 
                        option.setAttribute('selected', true);
                    
                    selectBox.appendChild(option);
                });
            });
        });
    </script>
@endsection