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

            // Unread Button 
            
            let unread_button = document.querySelector('.btn-unread');

            unread_button.addEventListener('click' , () => {
                if(checkedItems.length == 0)
                    return;
                
                
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