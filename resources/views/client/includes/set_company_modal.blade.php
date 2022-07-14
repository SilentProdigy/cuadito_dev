<!-- Modal -->
<div class="modal fade" id="set-company-modal" tabindex="-1" aria-labelledby="set-company-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Set Company Config</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3 auth-form">
                <form method="POST" action="{{ route('client.global.config.update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p>Please select the company that you would like to use for browsing projects or submitting proposals.</p>

                            <select name="company_id" class="form-control" selected>
                                <option value="">Select Company Below</option>
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}" {{ session('config.company') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 mx-0">
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end fixed-bottom p-4">
    <button type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#set-company-modal">
        <span class="fa fa-cog"></span>
    </button>
</div>