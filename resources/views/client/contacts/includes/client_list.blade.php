@foreach ($clients as $item)
    <div class="col-xl-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img
                        src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                        />
                        <div class="ms-3">
                        <p class="fw-bold mb-1">{{ $item->name }}</p>
                        <p class="text-muted mb-0">{{ $item->email }}</p>
                        </div>
                    </div>
                    <span class="badge rounded-pill badge-success">Active</span>
                </div>
            </div>
            <div class="card-footer border-0 bg-light p-2 d-flex justify-content-around">
                @if($item->is_connected)
                    <a class="btn btn-link m-0 text-reset" href="{{ route('client.conversations.create', ['email' => $item->email]) }}" role="button" data-ripple-color="primary">
                        Message<i class="fas fa-envelope ms-2"></i>
                    </a>

                    <a 
                        class="btn btn-link m-0 text-reset btn-delete-client"
                        href="#"
                        role="button"
                        data-ripple-color="primary"
                        data-contact='@json($item)'
                        >Delete<i class="fas fa-trash ms-2"></i
                    ></a>
                @else 
                    <button 
                    class="btn btn-link m-0 text-reset btn-connect" 
                    role="button" 
                    data-ripple-color="primary" 
                    data-client='@json($item)'>
                        Connect<i class="fas fa-plus ms-2"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>
@endforeach