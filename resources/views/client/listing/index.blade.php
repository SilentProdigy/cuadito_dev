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
        </form>
    </div>

    <section class="mt-4">

        <h4>Projects in CUADITO</h4>
        <p>Find the perfect projects for you.</p>
        
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-xs-12 col-md-6 gy-3">
                    <div class="card h-100 py-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ $project->title }}</h5>
                                </div>
                                <div class="col d-flex justify-content-end proposal-label">
                                    <span class="text-muted">Proposals:</span>&nbsp;
                                    <span>
                                        {{ $project->proposals_count }}
                                    </span>
                                </div>
                            </div>
                            @foreach ($project->categories as $category)
                                <span class="badge rounded-pill bg-dark">{{ $category->name }}</span>
                            @endforeach
                            <div class="fw-light pt-3">
                                <a href="{{ route('client.companies.show', $project->company) }}" class="text-muted"><h6>{{ $project->company->name }}</h6></a>
                            </div>
                            <div class="fw-normal fs-6 text-muted row">
                                <div class="col"><i class="fa-sharp fa-solid fa-pen-to-square"></i> {{ $project->created_at->format('M d,Y') }}</div>
                                <div class="col d-flex justify-content-end">Open until {{ $project->max_active_date }}</div>
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

@include('client.includes.set_company_modal')
@endsection

@section('script')

@endsection