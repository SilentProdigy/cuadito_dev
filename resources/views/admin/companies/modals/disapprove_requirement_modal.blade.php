  <!-- Modal -->
  <div class="modal fade" id="disapprove-requirement-modal" tabindex="-1" aria-labelledby="disapprove-requirement-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Disapprove Requirement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form method="POST" action="#" id="disapprove-requirement-form">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p>You are going to disapprove this requirement, please try to indicate the reason on the textbox below.</p>   
                            <textarea name="remarks" rows="3" class="form-control" placeholder="Add some notes if neccessary"></textarea>
                            <input type="hidden" name="status" value="DISAPPROVED">
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