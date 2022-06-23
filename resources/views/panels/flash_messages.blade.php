<div class="col-12">
    @if(session()->has('success'))
        <div class="alert alert-success d-flex justify-content-between" role="alert">
            <div class="alert-body">
                <i data-feather='check'></i>
                <span>
                    &nbsp; {{ session()->get('success') }}
                </span>
            </div>
            <a class="float-end text-success" data-bs-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
        </div>
    @endif

    @if(session()->has('errors'))
        <div class="alert alert-danger d-flex justify-content-between" role="alert">
            <div class="alert-body">
                <i data-feather='alert-circle'></i>
                <span><strong> Error!</strong></span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <a class="float-end text-success" data-bs-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
        </div>
    @endif
</div>