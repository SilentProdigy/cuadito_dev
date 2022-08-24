<ul>
    <li class="title">
        Rooms
    </li>
    <li>
        <a href="{{ route('client.inbox.index') }}"><i class="fa fa-inbox"></i> Inbox 
            <span class="label label-danger">{{ $unread_data['inbox'] }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('client.inbox.starred') }}"><i class="fa fa-star"></i> Stared</a>
    </li>
    <li>
        <a href="{{ route('client.inbox.sent') }}"><i class="fa fa-rocket"></i> Sent</a>
    </li>
    <li>
        <a href="{{ route('client.inbox.archived') }}"><i class="fa fa-archive"></i> Archive</a>
    </li>
    <li>
        <a href="{{ route('client.inbox.important') }}">
            <i class="fa fa-bookmark"></i> Important<span class="label label-info">{{ $unread_data['important'] }}</span>
        </a>
    </li>
</ul>