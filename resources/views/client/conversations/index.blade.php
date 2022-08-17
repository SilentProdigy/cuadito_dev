@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Inbox</div>
        <div class="col d-flex justify-content-end">
            <button class="btn btn-warning header-btn" data-bs-toggle="modal" data-bs-target="#create-new-conversation-modal">
                <i class="fa fa-plus"></i>&ensp;New Email
            </button>
        </div>
    </div>
</div>

@foreach ($conversation_subscriptions as $item)
    <section class="border p-4 border-2 rounded my-2">
        <div>
            <div class="d-flex justify-content-between align-content-center">
                <p class="fs-5 fw-bold">John Doe</p>
                <p class="fs-5 fw-bold">Aug. 17, 2022</p>
            </div>

            <p class="fs-6 fw-bold">{{ $item->conversation->subject }}</p>

        </div>

        <div>
            <p class="fs-6 fw-light">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis minima tempora facilis recusandae officia ad perferendis, tempore, ab assumenda natus dolorum voluptas aliquid obcaecati illo nulla. Eaque sequi delectus impedit sunt doloribus ipsa nesciunt porro eligendi consectetur facere commodi, nihil ipsum, earum dolore dolor! Incidunt consequuntur, dicta dolorem illum aliquid, illo facere consectetur corrupti magnam quos quisquam, cumque sapiente consequatur facilis iusto nihil debitis. Eius natus veniam illo non ratione repellat atque quod sapiente veritatis dolor, ex doloribus nisi alias fuga facere reprehenderit odio fugiat incidunt consectetur et mollitia, reiciendis perferendis in. Sapiente quis, consequatur vitae sequi architecto atque iste.
            </p>
        </div>

        <div class="d-flex justify-content-end align-content-center">
            <a href="#" class="text-info p-1">
                <i class="fa fa-eye"></i>
            </a>
            <a href="#" class="text-dark p-1">
                <i class="fa fa-archive"></i>
            </a>
            <a href="#" class="text-success p-1">
                <i class="fa fa-star"></i>
            </a>
            <a href="#" class="text-danger p-1">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </section>
@endforeach

{{-- <div class="card">
    <div class="card-body">
        
            <div class="border-top border-3 py-4">
                <div class="d-flex flex-row d-align-items-center justify-content-between">
                    
                    <p>Latest Date Reply</p>
                </div>
                <p>
                    Latest Message
                </p>
                <a href="{{ route('client.conversations.show', $item->conversation) }}">View</a>
            </div>
        @endforeach        
    </div>
</div> --}}

@include('client.conversations.includes.create_conversation_modal')
@endsection

@section('script')
   
@endsection