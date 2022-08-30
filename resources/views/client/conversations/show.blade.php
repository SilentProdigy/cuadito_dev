@extends('client.inbox.includes.inbox_layout')

@section('main_room_section')
    <h4>{{ $conversation->subject }}</h4>

    <div style="display: none" data-subscription="{{ json_encode($subscription) }}" id="subscription-div">aaa</div>

    @foreach ($messages as $message)
        <section class="border p-4 border-2 rounded my-2">
            <div>
                <div class="d-flex justify-content-between align-content-center">
                    <div class="fs-6 fw-bold">    
                        {{ $message->sender->name }}
                    </div>
                    <p class="fs-6 fw-bold">{{ $message->created_at->format('M d, Y') }}</p>
                </div>

                <div>
                    <p class="fs-6 fw-light">{{ $message->content }}</p>	
                </div>
            </div>
        </section>
    @endforeach

    <div class="my-3 p-2 border">
        <h6 class="my-3">Reply:</h6>
        <form action="{{ route('client.messages.store', $conversation) }}" method="POST">
            @csrf
            <textarea name="content" rows="5" class="form-control border border-3 border-dark  @error('content') is-invalid @enderror" placeholder="Enter message here ..."></textarea><br>
            <input type="submit" value="Send Message" class="btn btn-primary my-2">
        </form>
    </div>
@endsection
