@if($featured_projects->count() > 0)
    @foreach($featured_projects as $project)
        <div class="col-md-6 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-project-titles">
                            {{ $project->title }}
                        </h5>
                    </div>
                    @foreach ($project->categories as $category)
                        <span class="badge bg-success">{{ $category->name }}</span>
                    @endforeach
                    
                    <p class="text-muted card-project-desc">
                        {{ $project->description }}
                    </p>
                </div>
                <div class="card-footer">
                    {!!  $project->status_badge !!}
                    <br>
                    Cost: <span class="card-project-cost fw-bold">@money($project->cost)</span>
                    <br>
                    Due Date: <span class="card-project-due fw-bold">{{ $project->max_active_date }}</span>
                </div>
            </div>
        </div>
    @endforeach
@else
    <span>No featured projects yet.</span>
@endif