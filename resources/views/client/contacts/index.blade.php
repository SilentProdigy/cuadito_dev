@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Your Contacts</div>
        <div class="col d-flex justify-content-end">
            <a href="{{ route('client.contacts.create') }}" class="btn btn-primary header-btn">
                <i class="fa fa-plus"></i>&ensp;Add Contact
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table">
            <thead>
                {{-- <th>SEQ</th> --}}
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
                                <a href="#" class="btn btn-sm btn-info">
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
</div>

@endsection

@section('script')

@endsection