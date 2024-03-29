@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left text-muted"></i></a>&nbsp;Update Project Form</div>
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

                <div class="col-md-12 mt-3">
                    <label>Category</label><br>
                    @foreach ($categories as $category)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="category_ids[]" type="checkbox" value="{{ $category->id }}" id="{{ $category->id }}" {{ in_array($category->id, $selected_category_ids) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                    @endforeach
                    {{-- 
                    <select name="category_ids[]" id="" class="mt-1 form-select @error('category_ids') is-invalid @enderror">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ in_array($category->id, $selected_category_ids) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    --}}

                    @error('category_ids')
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
                    <label>Cost</label>
                    <input 
                        type="text" 
                        class="mt-1 form-control @error('cost') is-invalid @enderror" 
                        name="cost" 
                        value="{{ $project->cost }}" 
                        placeholder="* Enter Project Cost"
                        required 
                        autocomplete="" 
                        autofocus>

                    @error('cost')
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
                    <label>Due Date</label>
                    <input 
                        type="date" 
                        class="mt-1 form-control @error('due_date') is-invalid @enderror" name="due_date" 
                        value="{{ $project->due_date }}" 
                        placeholder="* Enter Project Due Date" 
                        required 
                        autocomplete="due_date" 
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
            <button type="submit" class="btn btn-warning">Update Project</button>
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection