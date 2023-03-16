@extends('layouts.client-layout')
@section('page_title', 'Projects Available')

@section('style')
<style>
    .right-elements{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card img{
        opacity: 0.3;
    }
</style>
@endsection

@section('content')
<div class="container px-5">
    <div class="page-breadcrumbs">
        <div class="page-title">Projects Available</div>
        <div class="right-elements">
            <div><a href="#" class="text-orange">Projects</a> / Projects Available</div>
            &ensp;
            <div>
                <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#advance-search-modal"><i class="bx bx-slider-alt fs-5 text-black"></i></a>
                @if(request()->has('search') || request()->has('adv_search'))
                    <a href="{{ route('client.listing.index') }}"><i class="bx bx-x"></i></a>
                @endif
            </div>
        </div>
    </div>

    <div class="container px-5">
        <div class="row" id="project-grid">
            <div class="col-xs-12 col-md-4 gy-3">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <h5 class="card-title text-black">Project 001</h5>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                            <span class="badge rounded-pill bg-orange">Medical</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 1, 2023</small>
                            </div>
                            <div class="start-date">
                                <small class="text-black">Start Date: March 15, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            This is a wider card with supporting text below as a natural lead-in to additional
                            content. This content is a little bit longer...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black px-3"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange px-3"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 gy-3">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <h5 class="card-title text-black">Project 001</h5>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                            <span class="badge rounded-pill bg-orange">Medical</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 1, 2023</small>
                            </div>
                            <div class="start-date">
                                <small class="text-black">Start Date: March 15, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            This is a wider card with supporting text below as a natural lead-in to additional
                            content. This content is a little bit longer...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black px-3"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange px-3"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 gy-3">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <h5 class="card-title text-black">Project 001</h5>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                            <span class="badge rounded-pill bg-orange">Medical</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 1, 2023</small>
                            </div>
                            <div class="start-date">
                                <small class="text-black">Start Date: March 15, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            This is a wider card with supporting text below as a natural lead-in to additional
                            content. This content is a little bit longer...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black px-3"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange px-3"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 gy-3">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <h5 class="card-title text-black">Project 001</h5>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                            <span class="badge rounded-pill bg-orange">Medical</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 1, 2023</small>
                            </div>
                            <div class="start-date">
                                <small class="text-black">Start Date: March 15, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            This is a wider card with supporting text below as a natural lead-in to additional
                            content. This content is a little bit longer...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black px-3"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange px-3"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 gy-3">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <h5 class="card-title text-black">Project 001</h5>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                            <span class="badge rounded-pill bg-orange">Medical</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 1, 2023</small>
                            </div>
                            <div class="start-date">
                                <small class="text-black">Start Date: March 15, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            This is a wider card with supporting text below as a natural lead-in to additional
                            content. This content is a little bit longer...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black px-3"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange px-3"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 gy-3">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <h5 class="card-title text-black">Project 001</h5>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                            <span class="badge rounded-pill bg-orange">Medical</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 1, 2023</small>
                            </div>
                            <div class="start-date">
                                <small class="text-black">Start Date: March 15, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            This is a wider card with supporting text below as a natural lead-in to additional
                            content. This content is a little bit longer...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black px-3"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange px-3"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
        </div>

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
    </div>
</div>

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
