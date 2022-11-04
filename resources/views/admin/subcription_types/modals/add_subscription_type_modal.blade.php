  <!-- Modal -->
  <div class="modal fade" id="add-product-modal" tabindex="-1" aria-labelledby="add-product-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Add New Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mx-3 auth-form">
            <form method="POST" action="{{ route('admin.subscription-types.store') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" placeholder="Amount" required>

                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="10" placeholder="Description"></textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 mx-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create Product') }}
                    </button>
                </div>

                <hr>
            </form>
        </div>
        </div>
    </div>
</div>