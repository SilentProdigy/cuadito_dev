  <!-- Modal -->
  <div class="modal fade" id="set-user-status-modal" tabindex="-1" aria-labelledby="set-user-status-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Set Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form method="POST" action="#" id="set-user-status-form">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <select name="status" id="" class="form-control" selected>
                                <option value="">Select Status below</option>
                                <option value="1">ACTIVATE</option>
                                <option value="0">DEACTIVATE</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 mx-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update Status') }}
                        </button>
                    </div>

                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>