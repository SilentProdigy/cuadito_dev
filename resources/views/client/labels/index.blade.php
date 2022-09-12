@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Your Labels</div>
        <div class="col d-flex justify-content-end">
            <button class="btn btn-primary header-btn" data-bs-toggle="modal" data-bs-target="#add-label-modal">
                <i class="fa fa-plus"></i>&ensp;Add Label
            </button>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table">
            <thead>
                <th>SEQ</th>
                <th class="col-span-2">LABEL</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>
                @foreach ($labels as $label)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="col-span-2">{{ $label->name }}</td>
                        <td class="user-actions">
                            <a href="#" class="btn btn-sm btn-warning">
                                <i class="fa fa-pencil"></i>          
                            </a>                            
                            <a href="#" class="btn btn-sm btn-danger btn-delete" data-label="{{ json_encode($label) }}">
                                <i class="fa fa-trash"></i>
                            </a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('client.inbox.includes.create_label_modal')
@endsection

@section('script')
    
@endsection