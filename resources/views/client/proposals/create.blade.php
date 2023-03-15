@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid pb-5">

    <h2>Submit a Proposal</h2>

    {{-- Project Details --}}
    <div class="card">
        <div class="card-header">
            <h4>Project Details</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5>{{ $project->title }}</h5>    
                <p>{{ $project->created_at }}</p>
            </div>            

            <div>
                @foreach ($project->categories as $category)
                    <span class="badge rounded-pill bg-dark">{{ $category->name }}</span>
                @endforeach
            </div>

            <div class="my-2 py-3 border-top">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Description</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $project->description }}</p>

                <a href="{{ route('client.listing.show', $project) }}">View Project Details</a>
            </div>
        </div>
    </div>

    {{-- Submit Proposal Form --}}
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4>Proposal Form</h4>
            </div>
        </div>

        <form action="{{ route('client.proposals.store', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body px-5">
                <div class="card">
                    <div class="card-header bg-dark text-white text-uppercase fw-bold">Rate</div>
                    <div class="card-body px-5">
                        <div class="input-group mb-3">
                            <span class="input-group-text">&#8369;</span>
                            <input type="number" class="form-control @error('rate') is-invalid @enderror" aria-label="Amount (to the nearest dollar)" name="rate" value="{{ old('rate') }}">
                            {{-- <span class="input-group-text">.00</span> --}}
                        </div>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header bg-dark text-white text-uppercase fw-bold">Cover Letter</div>
                    <div class="card-body px-5">
                        <div class="mb-3">
                            <textarea name="cover_letter" class="form-control @error('cover_letter') is-invalid @enderror" id="exampleFormControlTextarea1" rows="8" placeholder="Please provide your cover letter">{{ old('cover_letter') }}</textarea>
                        </div>
                    </div>
                </div>  

                <div class="card my-4">
                    <div class="card-header bg-dark text-white text-uppercase fw-bold">Requirements</div>
                    <div class="card-body px-5">
                        @foreach ($project->requirements as $requirement)
                            <label for="" class="fw-bold">{{ $requirement->requirement_name }}</label>
                            <div class="input-group mb-3">
                                <input type="file" name="requirements_{{$requirement->id}}" required>
                            </div>
                        @endforeach
                    </div>
                </div>  
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success mx-2">Submit A Proposal</button>
                    <a href="{{ route('client.listing.index') }}" class="btn btn-outline-secondary">Cancel</a>  
                </div>
            </div>
        </form>
    </div>
</div>

@include('client.includes.set_company_modal')
@endsection

@section('script')

@endsection