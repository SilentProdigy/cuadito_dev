<ul>
    <li class="title my-2">
        <div class="d-flex justify-content-between align-items-center">
            <p>Labels</p>
            <button class="btn btn-sm btn-dark" id="add-label-btn">Add Label</button>
        </div>
    </li>
    @foreach ($labels as $label)
    <li>
        <a href="#">{{ $label->name }} <span class="label label-danger"></span></a>
    </li>
    @endforeach
</ul>