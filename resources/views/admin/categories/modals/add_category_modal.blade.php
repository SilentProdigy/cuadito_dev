  <!-- Modal -->
  <div class="modal fade" id="add-category-modal" tabindex="-1" aria-labelledby="add-category-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="">Category:</label>
                            <input type="text" name="name" class="form-control" >
                        </div>
                    </div>

                    <div class="row mb-3 mx-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add Category') }}
                        </button>
                    </div>

                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>