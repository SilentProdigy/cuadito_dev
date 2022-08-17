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
                <div class="fs-5 fw-bold">{{ $item->conversation->other_client->name }}</div>
                <p class="fs-5 fw-bold">{{ $item->conversation->latest_message->created_at->format('M d, Y') }}</p>
            </div>

            <p class="fs-6 fw-bold">{{ $item->conversation->subject }}</p>
        </div>

        <div>
            <p class="fs-6 fw-light">
                {{ $item->conversation->latest_message->content }}
            </p>
        </div>

        <div class="d-flex justify-content-end align-content-center">
            <a href="{{ route('client.conversations.show', $item->conversation) }}" class="text-info p-1">
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

<section class="mt-3 d-flex justify-content-center">
    {{-- <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
    </nav> --}}
     
    {{ $conversation_subscriptions->links() }}
</section>


@include('client.conversations.includes.create_conversation_modal')
@endsection

@section('script')
   
@endsection