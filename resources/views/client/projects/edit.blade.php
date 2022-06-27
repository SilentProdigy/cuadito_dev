@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Update Project Form</div>
        <div class="col d-flex justify-content-end">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('client.projects.update', $project) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Title</label>
                    <input type="text" class="mt-1 form-control @error('title') is-invalid @enderror" name="title" value="{{ $project->title }}" placeholder="* Enter Project Title" required autocomplete="title" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-6">
                    <label>Company</label>
                    <select name="company_id" id="" class="mt-1 form-control @error('company_id') is-invalid @enderror"">
                        <option value="">Select Company</option>
                        @foreach ($companies as $item)
                            <option value="{{ $item->id }}" {{ $project->company_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>

                    @error('company_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-12 mt-3">
                    <label>Description</label>
                    <textarea name="description" id="" cols="30" rows="3" class="mt-1 form-control @error('description') is-invalid @enderror">{{ $project->description }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <input type="submit" value="Update Project" class="btn btn-warning">
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection