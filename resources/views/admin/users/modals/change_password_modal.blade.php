  <!-- Modal -->
  <div class="modal fade" id="change-user-password-modal" tabindex="-1" aria-labelledby="change-user-password" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Change Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mx-3 auth-form">
            <form method="POST" action="" id="change-password-form">
                @csrf
                @method('PATCH')

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    </div>
                </div>


                <div class="row mb-3 mx-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Change Password') }}
                    </button>
                </div>

                <hr>
            </form>
        </div>
        </div>
    </div>
</div>