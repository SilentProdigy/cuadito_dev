@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Notifications</div>
        <div class="col d-flex justify-content-end">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table">
            <thead>
                <th>SEQ</th>                
                <th>NOTIFICATION</th>                
                <th>ACTIONS</th>
            </thead>
            <tbody>

                @forelse ($notifications as $notification)
                    <tr>
                        <td class="d-flex flex-row">
                            <div class="d-flex flex-column user-listing-details px-3">
                                <span>{{ $loop->iteration }}</span>
                            </div>
                        </td>
                        <td>
                            <span>
                                <a href="{{ $notification->url }}" target="_blank" rel="noopener noreferrer">
                                    {{ $notification->content }}
                                </a>
                            </span>
                        </td>
                        <td class="user-actions">
                            @if(!$notification->opened)
                                <a href="{{ $notification->url }}" class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-envelope"></i>         
                                </a>
                            @else
                                <a href="#" class="btn btn-sm btn-outline-success">
                                    <i class="fa fa-envelope-open"></i>          
                                </a>
                            @endif

                            <a href="#" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>        
                @empty
                    <tr>
                        <td>You are all caught up!</td>
                    </tr>
                @endforelse
            
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')

@endsection