<div>
    <span class="btn-group">
        <button class="btn btn-default btn-unread"><span class="fa fa-envelope"></span></button>
        @if(request()->route()->getName() !== 'client.inbox.starred')
            <button class="btn btn-default btn-star"><span class="fa fa-star"></span></button>
        @else 
            <button class="btn btn-default btn-unstar"><span class="fa fa-star-o"></span></button>
        @endif

        @if(request()->route()->getName() !== 'client.inbox.important')
            <button class="btn btn-default btn-important"><span class="fa fa-bookmark"></span></button>
        @else 
            <button class="btn btn-default btn-unimportant"><span class="fa fa-bookmark-o"></span></button>
        @endif
    </span>

    {{-- <span class="btn-group">
        <button class="btn btn-default"><span class="fa fa-mail-reply"></span></button>
        <button class="btn btn-default"><span class="fa fa-mail-reply-all"></span></button>
        <button class="btn btn-default"><span class="fa fa-mail-forward"></span></button>
    </span> --}}

    <span class="btn-group">
        @if(request()->route()->getName() !== 'client.inbox.archived')
            <button class="btn btn-default btn-archive"><span class="fa fa-archive"></span></button>
        @else 
            <button class="btn btn-default btn-unarchive"><span class="fa fa-box-open"></span></button>
        @endif

        <button class="btn btn-default btn-delete"><span class="fa fa-trash-o"></span></button>
    </span>

    <span class="btn-group">
        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="fa fa-tags"></span> <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="#">add label <span class="label label-danger"> Home</span></a></li>
            <li><a href="#">add label <span class="label label-info">Job</span></a></li>
            <li><a href="#">add label <span class="label label-success">Clients</span></a></li>
            <li><a href="#">add label <span class="label label-warning">News</span></a></li>
        </ul>
    </span> 

    <span class="btn-group pull-right">
        <button class="btn btn-default"><span class="fa fa-chevron-left"></span></button>
        <button class="btn btn-default"><span class="fa fa-chevron-right"></span></button>
    </span>
</div>