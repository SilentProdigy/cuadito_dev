<div class="panel panel-default">       
    <div class="panel-body contacts">
        
        <a href="{{ route('client.contacts.create') }}" class="btn btn-success btn-block"> + Contact</a>

        <ul>
            @foreach($contacts as $item)
                <li>
                    <a href="{{ route('client.conversations.create', ['email' => $item->contact_email]) }}">
                        <span class="label label-danger"></span> {{ $item->contact_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    
    </div>

</div>