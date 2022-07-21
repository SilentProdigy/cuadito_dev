  <!-- Modal -->
  <div class="modal fade" id="set-project-winner-modal" tabindex="-1" aria-labelledby="set-project-winner-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Set Winning Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form method="POST" action="#" id="set-project-winner-form">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p>You are choosing <span id="company-name" class="text-danger fw-bold">Company</span> with the Proposal #ID of <span id="proposal-id" class="text-danger fw-bold">#00012</span>
                               as the winner of this project.<br>Note that this action will mark the project's status to CLOSED. 
                            </p>    

                            <textarea name="remarks" rows="3" class="form-control" placeholder="Add some notes if neccessary"></textarea>
                            <input type="hidden" name="winner_bidding_id" id="winner_bidding_id">
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