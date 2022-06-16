<div class="col-12">
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            <div class="alert-body">
                <i data-feather='check'></i>
                <span>
                    &nbsp; {{ session()->get('success') }}
                </span>
            </div>
        </div>
    @endif

    @if(session()->has('errors'))
        <div class="alert alert-danger" role="alert">
            <div class="alert-body">
                <i data-feather='alert-circle'></i>
                <span><strong> Error!</strong></span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>