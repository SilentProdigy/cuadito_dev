  <!-- Modal -->
  <div class="modal fade" id="edit-user-modal" tabindex="-1" aria-labelledby="edit-user-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Edit User Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mx-3 auth-form">
            <form method="POST" action="" id="edit-user-form">
                @csrf
                @method('PATCH')
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="edit-name-text" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="edit-email-text" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <select name="role" id="edit-role-text" class="form-control" selected>
                            <option value="">Select role below</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 mx-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Account') }}
                    </button>
                </div>

                <hr>
            </form>
        </div>
        </div>
    </div>
</div>