  <!-- Modal -->
  <div class="modal fade" id="set-company-status-modal" tabindex="-1" aria-labelledby="set-company-status-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Set Company Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form method="POST" action="#" id="set-company-status-form">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <select name="validation_status" id="validation_status" class="form-control" selected>
                                <option value="">Select Status below</option>
                                @foreach ($company_states as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <textarea style="display: none;" rows="5" name="remarks" class="form-control" id="remarks-text-area" placeholder="Enter remarks here ..."></textarea>
                        </div>
                    </div>

                    <div class="row mb-3 mx-0">
                        <button type="submit" class="btn btn-primary" id="btn-update-status">
                            {{ __('Update Status') }}
                        </button>
                    </div>

                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>