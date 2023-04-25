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
        opacity: 0.2;
    }
    .card-img-top{height: 8rem;}
    .page-item.active .page-link{background-color: #F96B23;}
    .project-cards{padding: 20px;}
    .card-text{font-size: 12px;}
    .card .rounded-pill{padding: 3px 20px;}
    .card-footer{padding-top: 5%; padding-bottom: 5%}
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-breadcrumbs">
        <div class="page-title">Projects Available</div>
        <div class="right-elements">
            &ensp;
            <div>
                <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#advance-search-modal"><i class="bx bx-slider-alt fs-5 text-black"></i></a>
                @if(request()->has('search') || request()->has('adv_search'))
                    <a href="{{ route('client.listing.index') }}"><i class="bx bx-x"></i></a>
                @endif
            </div>
        </div>
    </div>

    <hr>

    <div class="d-flex justify-content-between">
        <div>
            <!-- <span>Showing 1 to 9 of {{ $projects->count() }} entries</span> -->
        </div>
        <div>
            <div class="pagination">
                <!--<li class="page-item previous-page disable"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item current-page active"><a class="page-link" href="#">1</a></li>
                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
                <li class="page-item next-page"><a class="page-link" href="#">Next</a></li>-->
            </div>
        </div>
    </div>

    <div class="container" id="project-grid">
        
        <div class="row">

            <!-- Dummy Projects -->
            <div class="col-xs-12 col-md-4 project-cards">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <div class="d-flex justify-content-between text-green">
                            <h5 class="card-title text-black">Project 001</h5>
                            <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                        </div>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 29, 2023</small>
                            </div>
                            <div class="due-date">
                                <small class="text-black">Due Date: March 31, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text lh-sm">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 project-cards">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <div class="d-flex justify-content-between text-green">
                            <h5 class="card-title text-black">Project 001</h5>
                            <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                        </div>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 29, 2023</small>
                            </div>
                            <div class="due-date">
                                <small class="text-black">Due Date: March 31, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text lh-sm">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 project-cards">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <div class="d-flex justify-content-between text-green">
                            <h5 class="card-title text-black">Project 001</h5>
                            <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                        </div>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 29, 2023</small>
                            </div>
                            <div class="due-date">
                                <small class="text-black">Due Date: March 31, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text lh-sm">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 project-cards">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <div class="d-flex justify-content-between text-green">
                            <h5 class="card-title text-black">Project 001</h5>
                            <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                        </div>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 29, 2023</small>
                            </div>
                            <div class="due-date">
                                <small class="text-black">Due Date: March 31, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text lh-sm">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 project-cards">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <div class="d-flex justify-content-between text-green">
                            <h5 class="card-title text-black">Project 001</h5>
                            <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                        </div>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 29, 2023</small>
                            </div>
                            <div class="due-date">
                                <small class="text-black">Due Date: March 31, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text lh-sm">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 project-cards">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <div class="d-flex justify-content-between text-green">
                            <h5 class="card-title text-black">Project 001</h5>
                            <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                        </div>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 29, 2023</small>
                            </div>
                            <div class="due-date">
                                <small class="text-black">Due Date: March 31, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text lh-sm">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 project-cards">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <div class="d-flex justify-content-between text-green">
                            <h5 class="card-title text-black">Project 001</h5>
                            <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                        </div>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 29, 2023</small>
                            </div>
                            <div class="due-date">
                                <small class="text-black">Due Date: March 31, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text lh-sm">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 project-cards">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <div class="d-flex justify-content-between text-green">
                            <h5 class="card-title text-black">Project 001</h5>
                            <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                        </div>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 29, 2023</small>
                            </div>
                            <div class="due-date">
                                <small class="text-black">Due Date: March 31, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text lh-sm">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 project-cards">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <div class="d-flex justify-content-between text-green">
                            <h5 class="card-title text-black">Project 001</h5>
                            <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                        </div>
                        <div class="d-flex">
                            <span class="badge rounded-pill bg-green">Construction</span>
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: March 29, 2023</small>
                            </div>
                            <div class="due-date">
                                <small class="text-black">Due Date: March 31, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text lh-sm">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque...
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
                    </div>
                </div>
            </div>
            <!-- End of Dummy Projects -->
            @foreach ($projects as $project)
            <div class="col-xs-12 col-md-4 project-cards">
                <div class="card h-100">
                    <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/>
                    <div class="card-header card-img-overlay">
                        <div class="d-flex justify-content-between text-green">
                            <h5 class="card-title text-black">{{ $project->title }}</h5>
                            <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                        </div>
                        <div class="d-flex">
                            @foreach ($project->categories as $category)
                            <span class="badge rounded-pill bg-green">{{ $category->name }}</span>
                            @endforeach
                        </div>
                        <div class="project-dates">
                            <div class="start-date">
                                <small class="text-black">Start Date: {{ $project->created_at->format('M d,Y') }}</small>
                            </div>
                            <div class="due-date">
                                <small class="text-black">Due Date: {{ $project->due_date }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text lh-sm">
                            {!! $project->description_text !!}
                          </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="{{ route('client.listing.show', $project) }}" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                        &ensp;
                        <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
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

@section('script')

@endsection