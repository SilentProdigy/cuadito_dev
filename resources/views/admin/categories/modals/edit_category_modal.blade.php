  <!-- Modal -->
  <div class="modal fade" id="edit-category-modal" tabindex="-1" aria-labelledby="edit-category-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form method="POST" action="#" id="edit-category-form">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="text" name="name" class="form-control" id="category-name-txt" placeholder="Category name">
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <button type="submit" class="btn btn-outline-success">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>