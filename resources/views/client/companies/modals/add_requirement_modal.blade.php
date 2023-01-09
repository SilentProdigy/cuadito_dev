  <!-- Modal -->
  <div class="modal fade" id="add-requirement-modal" tabindex="-1" aria-labelledby="add-requirement-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Add New Requirement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form method="POST" action="{{ route('client.companies.requirements.store', $company) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="">Requirement Type:</label>
                            <select name="requirement_id" class="form-control" selected>
                                <option value="">Select Requirement Type Below</option>
                                @foreach ($missing_requirements as $type)
                                   <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="">File:</label><br>
                            <input type="file" name="requirement" style="border-raduis: none !important;">
                        </div>
                    </div>

                    <div class="row mb-3 mx-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add Requirement') }}
                        </button>
                    </div>

                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>