@extends('layouts.client-main-layout')

@section('content')
<div class="container px-5">
    <div class="my-3">
        <form action="{{ route('client.listing.index') }}" method="get">
            <div class="input-group input-group-lg mb-3">
                <input type="text" class="form-control " placeholder="Search Project ..." name="search" value="{{ request('search') }}">
                <button class="btn btn-warning" type="submit">
                    <span class="fa fa-search"></span>
                </button>
            </div>
            <a href="{{ route('client.listing.index') }}">Clear Search</a>
        </form>
    </div>

    <section class="mt-4">

        <h4>{{ request('search') ? 'We found ' . $projects->count() . ' results ...' : 'Projects you might like'}}</h4>
        
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-xs-12">
                    <div class="card my-3">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ $project->title }}</h5>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Proposals <span class="badge bg-secondary">{{ $project->proposals_count }}</span>
                                    </button>
                                </div>
                            </div>
                            @foreach ($project->categories as $category)
                                <span class="badge rounded-pill bg-dark">{{ $category->name }}</span>
                            @endforeach
                        </div>
                        <div class="card-body px-3">
                            <p class="fw-bold fs-6 text-start">
                                <a href="{{ route('client.companies.show', $project->company) }}" class="px-1">{{ $project->company->name }}</a> |
                                <span class="px-1">Posted at {{ $project->created_at->format('M d,Y') }}|</span>
                                <span class="px-1">Open till {{ $project->max_active_date }}</span>
                            </ul>
                            <p class="card-text">
                                {!! $project->description_text !!}
                            </p>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('client.listing.show', $project) }}" class="btn btn-sm btn-outline-success px-3">View</a>
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