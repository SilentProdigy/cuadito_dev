@foreach ($contacts as $item)
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
                    <p class="fw-bold mb-1">{{ $item->contact_name }}</p>
                    <p class="text-muted mb-0">{{ $item->contact_email }}</p>
                    </div>
                </div>
                <span class="badge rounded-pill badge-success">Active</span>
            </div>
        </div>
        <div class="card-footer border-0 bg-light p-2 d-flex justify-content-around">
            @if($item->is_existing_client)
                <a
                    class="btn btn-link m-0 text-reset"
                    href="#"
                    role="button"
                    data-ripple-color="primary"
                >Message<i class="fas fa-envelope ms-2"></i
                ></a>
                <a
                class="btn btn-link m-0 text-reset"
                href="#"
                role="button"
                data-ripple-color="primary"
                >Call<i class="fas fa-phone ms-2"></i
                ></a>
            @else 
                <a class="btn btn-link m-0 text-reset" href="{{ route('client.contacts.invite', $item) }}" role="button" data-ripple-color="primary">
                    Invite<i class="fas fa-paper-plane ms-2"></i>
                </a>
            @endif
        </div>
    </div>
</div>
@endforeach