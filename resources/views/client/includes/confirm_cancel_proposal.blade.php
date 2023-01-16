<div class="modal" tabindex="-1" id="confirm-cancel-proposal-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cofirm Action</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="mb-0 ml-1">
                Are you sure you want to <span class="text-danger text-bold">cancel</span> proposal for Project <span id="project-name"  class="text-danger text-bold"></span>?
            </p>

            <form action="#" method="post" id="cancel-proposal-form">
              @csrf
              @method('DELETE')
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="document.getElementById('cancel-proposal-form').submit()">Proceed</button>
        </div>
      </div>
    </div>
</div>  

