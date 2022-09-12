<ul>
    <li class="title my-2">
        <div class="d-flex justify-content-between align-items-center">
            <p>Labels</p>
            <button class="btn btn-sm btn-dark text-wrap" id="add-label-btn">Add Label</button>
            {{-- <a href="#"></a> --}}
        </div>
    </li>
    @foreach ($labels as $label)
    <li>
        <a href="{{ route('client.inbox.index') }}">{{ $label->name }}</a>
    </li>
    @endforeach
    <li>
        <a href="{{ route('client.labels.index') }}" class="text-info">Manage Labels</a>
    </li>
</ul>