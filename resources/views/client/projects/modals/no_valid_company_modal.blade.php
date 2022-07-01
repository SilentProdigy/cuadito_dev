<div class="modal" tabindex="-1" id="no-valid-company-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">No Valid Company</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="mb-0 ml-1">
                It appears that you don't have a valid/approved company. You should create first before posting a new project.
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a href="{{ route('client.companies.index') }}" class="btn btn-warning">Continue</a>
        </div>
      </div>
    </div>
  </div>