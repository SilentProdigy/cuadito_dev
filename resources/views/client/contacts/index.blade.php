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

<div class="container-fluid mb-3 d-flex flex-row">
    <div class="bg-white">
        <div class="row">
            @includeWhen(!request()->has('search'), 'client.contacts.includes.contact_list')
            @includeWhen(request()->has('search'), 'client.contacts.includes.client_list')
        </div>
    </div>
</div>

<!-- <div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table">
            <thead>
                <th>NAME</th>
                <th>EMAIL ADDRESS</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>
                @forelse ($contacts as $item)
                    <tr>
                        <td>
                            <span>{{ $item->name }}</span>
                        </td>
                        <td><span>{{ $item->email }}</span></td>
                        <td class="user-actions">
                            @if(!$item->contact)
                                <a href="{{ route('client.contacts.invite', $item) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-send"></i> Send Invitation
                                </a>
                            @endif 
                            <a href="#" class="btn btn-sm btn-danger btn-delete" data-contact="{{ json_encode($item) }}">
                                <i class="fa fa-trash"></i>
                            </a> 
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No contact records here!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div> -->

@endsection

@section('script')

@endsection