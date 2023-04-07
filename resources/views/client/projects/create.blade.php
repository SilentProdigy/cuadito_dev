@extends('layouts.client-layout')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .bootstrap-tagsinput{
        width: 100% !important;
        margin-top: 1%;
        padding-top: 4px;
        padding-bottom: 4px;
        min-height: auto;
    }
    .bootstrap-tagsinput input:focus{
        border-color: #ff5f00 !important;
        box-shadow: inset 0 0 0 1px #ff5f00 !important;
    }
    .bootstrap-tagsinput .tag{
        color: #757575 !important;
    }
    .bootstrap-tagsinput .label-info{display: inline-block;}
</style>

@endsection

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left text-muted"></i></a>&nbsp;Post A New Project Form</div>
        <div class="col d-flex justify-content-end">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('client.projects.store') }}" class="needs-validation" novalidate method="POST">
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
                    <select name="category_ids[]" id="" class="mt-1 form-control @error('category_ids') is-invalid @enderror">
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
                    <select name="company_id" id="" class="mt-1 form-control @error('company_id') is-invalid @enderror" required>
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
                    <label>Cost</label>
                    <input 
                        type="number" 
                        class="mt-1 form-control @error('cost') is-invalid @enderror" 
                        name="cost" 
                        value="{{ old('cost') }}" 
                        placeholder="* Php"
                        required 
                        autocomplete="" 
                        autofocus>

                    @error('cost')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-4 mt-3">
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
                
                <div class="col-md-4 mt-3">
                    <label>Due Date</label>
                    <input 
                        type="date" 
                        class="mt-1 form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}" placeholder="* Enter Project Max Date" 
                        required 
                        autocomplete="due_date" 
                        autofocus>

                    @error('due_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="col-md-4 mt-3">
                    <label>Requirements</label>
                    <input
                        type="text"
                        class="form-control p-4 @error('requirements_ids') is-invalid @enderror"
                        data-role="tagsinput"
                        name="requirement_ids[]"
                        value=""
                        placeholder="* Enter Requirements"
                        required
                        autofocus
                    />
                </div>

                <div class="col-md-12 mt-3">
                    <label>Description</label>
                    <textarea 
                        name="description" 
                        cols="30" 
                        rows="3" 
                        required
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
                        required
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
                        required
                        class="mt-1 form-control @error('terms_and_conditions') is-invalid @enderror">{{old('terms_and_conditions')}}</textarea>

                    @error('terms_and_conditions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

              
            </div>
            <button type="submit" class="btn btn-primary">Post Project</button>
        </form>
    </div>
</div>
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>


<script>
(() => {
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
</script>
@endsection