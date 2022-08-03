<div class="modal" tabindex="-1" id="confirm-delete-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cofirm Action</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="mb-0 ml-1">
                Are you sure you want to <span class="text-danger text-bold">delete</span> <strong id="category-name"></strong> in our Categories List?
            </p>
            
            <form action="#" method="post" id="delete-category-form">
            @csrf
              @method('DELETE')
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-category-form').submit()">Delete</button>
        </div>
      </div>
    </div>
  </div>