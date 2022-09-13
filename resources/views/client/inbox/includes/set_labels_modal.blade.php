  <!-- Modal -->
  <div class="modal fade" id="set-labels-modal" tabindex="-1" aria-labelledby="set-labels-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Set Label</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form action="{{ route('client.conversation-subs.set-labels') }}" method="POST" id="set-labels-convo-form">
                    @csrf
                    @method('PATCH')
                    <label>Select Label:</label>
                    <select id="label-select-box" class="select form-control" name="labels[]" multiple>
                    </select>

                    <input type="hidden" name="subscription_ids" id="labels-conversation-ids">

                    <div class="row mt-3 mx-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>