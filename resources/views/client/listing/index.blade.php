@extends('layouts.client-main-layout')

@section('content')
<div class="container px-5">
    <div class="my-3">
        <div class="input-group input-group-lg mb-3">
            <input type="text" class="form-control " placeholder="Search Project ...">
            <button class="btn btn-warning" type="button">
                <span class="fa fa-search"></span>
            </button>
        </div>
    </div>

    <section class="mt-4">
        <h4>Projects you might like</h4>
        
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
                        </div>
                        <div class="card-body px-3">
                            <p class="fw-bold fs-6 text-start">
                                <span class="px-1">{{ $project->company->name }}|</span>
                                <span class="px-1">Posted at {{ $project->created_at->format('M d,Y') }}|</span>
                                <span class="px-1">Open till {{ $project->max_active_date }}</span>
                            </ul>
                            <p class="card-text">
                                {{ $project->description }}
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
</div>
@endsection

@section('script')

@endsection