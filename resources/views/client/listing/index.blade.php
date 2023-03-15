@extends('layouts.client-main-layout')

@section('style')
<style>
    .proposal-label{
        font-size: 15px;
    }
</style>
@endsection

@section('content')
<div class="container px-5">
    <div class="my-3">
        <form action="{{ route('client.listing.index') }}" method="get">
            <div class="input-group input-group-lg mb-3">
                <input id="search-focus" type="text" class="form-control" placeholder="Search Project ..." name="search" value="{{ request('search') }}">
                <button class="btn border-orange btn-orange" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#advance-search-modal" style="margin-right: 2%;">Show Search Options</a>

            @if(request()->has('search') || request()->has('adv_search'))
                <a href="{{ route('client.listing.index') }}">Clear Search Results</a>
            @endif
        </form>
    </div>

    <section class="mt-4">

        <h4>Projects in CUADITO</h4>
        <p>Find the perfect projects for you.</p>
        
        @if(request()->has('search') || request()->has('adv_search'))
            <h5>Found {{ $projects->count() }} search results ... </h5>
        @endif

        <div class="row">
            @foreach ($projects as $project)
                <div class="col-xs-12 col-md-6 gy-3">
                    <div class="card h-100 py-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ $project->title }}</h5>
                                </div>
                            </div>
                            @foreach ($project->categories as $category)
                                <span class="badge rounded-pill bg-dark">{{ $category->name }}</span>
                            @endforeach
                            <div class="fw-light pt-3">
                                <a href="{{ route('client.companies.show', $project->company) }}" class="text-muted"><h6>{{ $project->company->name }}</h6></a>
                            </div>
                            <div class="fw-normal fs-6 text-muted">
                                <i class="fa-sharp fa-solid fa-pen-to-square"></i> {{ $project->created_at->format('M d,Y') }}
                            </div>
                        </div>
                        <div class="card-body px-3">
                            <p class="card-text">
                                {!! $project->description_text !!}
                            </p>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('client.listing.show', $project) }}" class="btn btn-sm btn-orange px-3">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mt-3 d-flex justify-content-center">
        {{-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item disabled">
                <a class="page-link">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
        </nav> --}}
         
        {{ $projects->links() }}
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="advance-search-modal" tabindex="-1" aria-labelledby="advance-search-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Advance Search</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3">
                <form method="GET" action="{{ route('client.listing.index') }}">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="" class="fw-bold">Filter By:</label>
                            <select class="form-control" name="filter_col">
                                <option value="">-- Please seelct an option</option>
                               @foreach ($search_options['filter_cols'] as $col)
                                   <option value="{{ $col['value'] }}" {{ $col['value'] == request('filter_col') ? 'selected' : '' }}>
                                        {{ $col['label'] }}
                                    </option>
                               @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="fw-bold">Having Value of:</label>
                            <input type="text" name="filter_val" class="form-control" value="{{ request()->input('filter_val') }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="" class="fw-bold">Sort By:</label>
                            <select class="form-control" name="sort_col">
                                <option value="">-- Please seelct an option</option>
                                @foreach ($search_options['sort_by_cols'] as $col)
                                   <option value="{{ $col['value'] }}" {{ $col['value'] == request('sort_col') ? 'selected' : '' }}>{{ $col['label'] }}</option>
                               @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="fw-bold">Ascending / Descending:</label>
                            <select class="form-control" name="sort_val">
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="adv_search" value="1">

                    {{-- <div class="row mb-4">
                        <div class="col-md-12">
                            <label for="" class="fw-bold">Search</label>
                            <input type="text" name="adv_search" class="form-control" placeholder="* search value here">
                        </div>
                    </div> --}}

                    <div class="row mb-4 mx-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Search') }}
                        </button>
                    </div>

                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection