  <!-- Modal -->
  <div class="modal fade" id="add-label-modal" tabindex="-1" aria-labelledby="add-label-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Add New Label</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form method="POST" action="{{ route('client.labels.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12 mt-3">
                            <label for="">Label:</label><br>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3 mx-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add Label') }}
                        </button>
                    </div>

                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>