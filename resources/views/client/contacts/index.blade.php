@extends('layouts.client-main-layout')

@section('content')
    <div class="container-fluid mb-3">
        <div class="d-flex flex-row d-align-items-center justify-content-center">
            <div class="table-titles">Your Contacts</div>
            <div class="col d-flex gap-4 flex-row-reverse">
                <a href="{{ route('client.contacts.create') }}" class="btn btn-orange header-btn">
                    <i class="fa fa-plus"></i>&ensp;Add Contact
                </a>
                <div>
                    <form action="{{ route('client.contacts.index') }}" method="GET">
                        <div class="input-group">
                            <div class="form-outline">
                                <input id="search-focus" type="search" id="form1" class="form-control" name="search"/>
                                <label class="form-label" for="form1">Search</label>
                            </div>
                            <button type="submit" class="btn border-orange btn-orange">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>

    <div class="container-fluid mb-3">
        <div class="bg-white">
            <div class="row">
                @includeWhen(!request()->has('search'), 'client.contacts.includes.contact_list')
                @includeWhen(request()->has('search'), 'client.contacts.includes.client_list')
            </div>
        </div>
    </div>

    <form action="{{ route('client.connect.store')}}" method="post" id="connect-form">
        @csrf
        <input type="hidden" name="contact_id" id="contact-id-txt">
    </form>

    <form action="#" method="post" id="delete-connect-form">
        @csrf
        @method('DELETE')
        <input type="hidden" name="contact_id" id="delete-contact-id-txt">
        <input type="hidden" name="type" id="delete-contact-type-txt">
    </form>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let connect_btns = document.querySelectorAll('.btn-connect');

        if(connect_btns) 
        {
            connect_btns.forEach(button => {
                button.addEventListener('click', function(e) {  
                    e.preventDefault;
                    let data = button.getAttribute('data-client');   
                    data = JSON.parse(data);

                    let form = document.querySelector('#connect-form');
                    // form.setAttribute('action', `/client/connect`);
                    $('#contact-id-txt').val(`${ data.id }`);
                    form.submit();
                });
            });   
        }
        
        let delete_contacts_btns = document.querySelectorAll('.btn-delete-contact');

        if(delete_contacts_btns) 
        {
            delete_contacts_btns.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault;
                    let data = button.getAttribute('data-contact');   
                    data = JSON.parse(data);
            
                    let form = document.querySelector('#delete-connect-form');
                    $('#delete-contact-id-txt').val(`${ data.id }`);
                    $('#delete-contact-type-txt').val('contact');

                    form.setAttribute('action', `/client/contacts`);
                    form.submit();
                });
            });
        }

        let delete_clients_btns = document.querySelectorAll('.btn-delete-client');
        if(delete_clients_btns) 
        {
            delete_clients_btns.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault;
                    let data = button.getAttribute('data-contact');   
                    data = JSON.parse(data);
                    
                    let form = document.querySelector('#delete-connect-form');
                    // form.setAttribute('action', `/client/connect`);
                    $('#delete-contact-id-txt').val(`${ data.id }`);
                    $('#delete-contact-type-txt').val('client');
                    
                    form.setAttribute('action', `/client/contacts`);
                    form.submit();
                });
            });
        }

    });
</script>
@endsection