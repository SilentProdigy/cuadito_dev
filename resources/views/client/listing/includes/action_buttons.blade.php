@if(!$is_owned_project)
    @if(!$has_proposal)
        <a href="{{ route('client.proposals.create', $project) }}" class="btn btn-outline-success">Submit A Proposal</a>
    @else
        <button class="btn btn-outline-secondary" disabled>Proposal Submitted</button>
    @endif
@else 
    <a href="{{ route('client.projects.show', $project) }}" class="btn btn-outline-success">View Proposals</a>
@endif

<a href="{{ route('client.listing.index') }}" class="btn btn-dark">Back</a>