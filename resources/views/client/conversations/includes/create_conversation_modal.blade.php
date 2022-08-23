  <!-- Modal -->
  <div class="modal fade" id="create-new-conversation-modal" tabindex="-1" aria-labelledby="create-new-conversation-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Create New Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form method="POST" action="{{ route('client.conversations.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="">Subject</label>
                            <input type="text" name="subject" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label for="">Recipient Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label for="">Content</label>
                            <textarea name="content" id="" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    

                    <div class="row mb-3 mx-0">
                        <button type="submit" class="btn btn-primary">
                            Send
                        </button>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>