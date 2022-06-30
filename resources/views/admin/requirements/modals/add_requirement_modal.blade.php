  <!-- Modal -->
  <div class="modal fade" id="addRequirementModal" tabindex="-1" aria-labelledby="addRequirementModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Add New Requirement</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mx-3 auth-form">
            <form method="POST" action="{{ route('admin.requirements.store') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Requirements" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <select name="required" id="" class="form-control @error('required') is-invalid @enderror">
                            <option value=""></option>
                            <option value="true">Required</option>
                            <option value="false">Optional</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3 mx-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create Requirement') }}
                    </button>
                </div>

                <hr>
            </form>
        </div>
        </div>
    </div>
</div>