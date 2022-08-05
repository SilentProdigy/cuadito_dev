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
                                <a href="{{ route('client.notifications.show', $notification) }}">
                                    {{ $notification->content }}
                                </a>
                            </span>
                        </td>
                        <td class="user-actions">
                            {{-- @if(!$notification->opened)
                                <a href="{{ $notification->url }}" class="btn btn-sm btn-outline-info btn-open-operation" data-notification="{{ json_encode($notification) }}"
                                    data-action="unread">
                                    <i class="fa fa-envelope"></i>         
                                </a>
                            @else
                                <a href="#" class="btn btn-sm btn-outline-success btn-open-operation" data-notification="{{ json_encode($notification) }}"
                                data-action="read">
                                    <i class="fa fa-envelope-open"></i>          
                                </a>
                            @endif --}}

                            <a href="#" class="btn btn-sm btn-danger btn-delete-notification" data-notification="{{ json_encode($notification) }}">
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

        <div class="d-flex justify-content-center">{{ $notifications->links() }}</div>
    </div>
</div>

@include('client.notifications.modals.confirm_delete_modal')
@endsection

@section('script')
    <script>
         $(document).ready(function() {
            let delete_buttons = document.querySelectorAll('.btn-delete-notification');

            delete_buttons.forEach(button => {
                button.addEventListener('click', function(e) {  
                    e.preventDefault;
                    let data = button.getAttribute('data-notification');   
                    data = JSON.parse(data);

                    let myModal = new bootstrap.Modal(document.getElementById('confirm-delete-modal'), {keyboard: false})
                    myModal.show()

                    // document.querySelector('#project-name').innerHTML = data.title;
                    let form = document.querySelector('#delete-notification-form');
                    form.setAttribute('action', `/client/notifications/${ data.id }`);

                });
            });
         });
    </script>
@endsection