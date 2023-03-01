@extends('layouts.client-main-layout')

@section('content')
    <div class="container-fluid mb-3">
        <div class="d-flex flex-row d-align-items-center justify-content-center">
            <div class="table-titles">Your Contacts</div>
            <div class="col d-flex justify-content-end">
                <a href="{{ route('client.contacts.create') }}" class="btn btn-orange header-btn">
                    <i class="fa fa-plus"></i>&ensp;Add Contact
                </a>
            </div>
        </div>
    </div>

    <div class="my-3">
        <form action="{{ route('client.contacts.index') }}" method="get">
            <div class="input-group input-group-lg mb-4">
                <input id="search-focus" type="text" class="form-control" placeholder="Search Contacts ..." name="search" value="{{ request('search') }}">
                <button class="btn border-orange btn-orange" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            {{-- <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#advance-search-modal" style="margin-right: 2%;">Show Search Options</a> --}}

            @if(request()->has('search') || request()->has('adv_search'))
                <a href="{{ route('client.contacts.index') }}">Clear Search Results</a>
            @endif
        </form>

        @if(request()->has('search') || request()->has('adv_search'))
            <div style="margin-top: 10px;">
                <h5>Found {{ $clients->count() }} search results ... </h5>
            </div>
        @endif
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
                    // form.setAttribute('action', `/connect`);
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

                    form.setAttribute('action', `/contacts`);
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
                    // form.setAttribute('action', `/connect`);
                    $('#delete-contact-id-txt').val(`${ data.id }`);
                    $('#delete-contact-type-txt').val('client');
                    
                    form.setAttribute('action', `/contacts`);
                    form.submit();
                });
            });
        }

    });
</script>
@endsection