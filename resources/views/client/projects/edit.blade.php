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
                <div class="col-md-12">
                    <label>Title</label>
                    <input type="text" class="mt-1 form-control @error('title') is-invalid @enderror" name="title" value="{{ $project->title }}" placeholder="* Enter Project Title" required autocomplete="title" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-6 mt-3">
                    <label>Company</label>
                    <select name="company_id" id="" class="mt-1 form-control @error('company_id') is-invalid @enderror">
                        <option value="">Select Company</option>
                        @foreach ($companies as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $project->company_id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach 
                    </select>

                    @error('company_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-6 mt-3">
                    <label>Cost & Payment</label>
                    <input 
                        type="text" 
                        class="mt-1 form-control @error('cost_and_payment') is-invalid @enderror" 
                        name="cost_and_payment" 
                        value="{{ $project->cost_and_payment }}" 
                        placeholder="* Enter Project Cost & Payment"
                        required 
                        autocomplete="" 
                        autofocus>

                    @error('cost_and_payment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-6 mt-3">
                    <label>Scope of Work</label>
                    <input 
                        type="text" 
                        class="mt-1 form-control @error('scope_of_work') is-invalid @enderror" name="scope_of_work" value="{{ $project->scope_of_work }}" placeholder="* Enter Project Scope of Work" 
                        required 
                        autocomplete="title" 
                        autofocus>

                    @error('scope_of_work')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="col-md-6 mt-3">
                    <label>Max Project Availability Date</label>
                    <input 
                        type="date" 
                        class="mt-1 form-control @error('max_date') is-invalid @enderror" name="max_date" 
                        value="{{ $project->max_date }}" 
                        placeholder="* Enter Project Max Date" 
                        required 
                        autocomplete="max_date" 
                        autofocus>

                    @error('max_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label>Description</label>
                    <textarea 
                        name="description" 
                        cols="30" 
                        rows="3" 
                        class="mt-1 form-control @error('description') is-invalid @enderror">{{ $project->description }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="col-md-12 mt-3">
                    <label>Relevant Authorities</label>
                    <textarea 
                        name="relevant_authorities" 
                        cols="30" 
                        rows="3" 
                        class="mt-1 form-control @error('relevant_authorities') is-invalid @enderror">{{$project->relevant_authorities}}</textarea>

                    @error('relevant_authorities')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label>Terms & Conditions</label>
                    <textarea 
                        name="terms_and_conditions"
                        cols="30" 
                        rows="3" 
                        class="mt-1 form-control @error('terms_and_conditions') is-invalid @enderror">{{ $project->terms_and_conditions }}</textarea>

                    @error('terms_and_conditions')
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