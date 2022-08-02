@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Post A New Project Form</div>
        <div class="col d-flex justify-content-end">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('client.projects.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <label>Title</label>
                    <input type="text" class="mt-1 form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="* Enter Project Title" required autocomplete="title" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-12 mt-3">
                    <label>Category</label>
                    <select name="category_ids[]" id="" class="mt-1 form-control @error('category_ids') is-invalid @enderror" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    @error('category_ids')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-6 mt-3">
                    <label>Company</label>
                    <select name="company_id" id="" class="mt-1 form-control @error('company_id') is-invalid @enderror"">
                        <option value="">Select Company</option>
                        @foreach ($companies as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                        value="{{ old('cost_and_payment') }}" 
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
                        class="mt-1 form-control @error('scope_of_work') is-invalid @enderror" name="scope_of_work" value="{{ old('scope_of_work') }}" placeholder="* Enter Project Scope of Work" 
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
                        class="mt-1 form-control @error('max_date') is-invalid @enderror" name="max_date" value="{{ old('max_date') }}" placeholder="* Enter Project Max Date" 
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
                        class="mt-1 form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>

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
                        class="mt-1 form-control @error('relevant_authorities') is-invalid @enderror">{{old('relevant_authorities')}}</textarea>

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
                        class="mt-1 form-control @error('terms_and_conditions') is-invalid @enderror">{{old('terms_and_conditions')}}</textarea>

                    @error('terms_and_conditions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

              
            </div>
            <input type="submit" value="Post Project" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection