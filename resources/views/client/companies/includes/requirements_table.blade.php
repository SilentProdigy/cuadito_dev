<table class="table table-borderless table-md user-listing-table">
    <thead>
        <th>SEQ</th>
        <th>REQUIREMENT</th>
        <th>ACTIONS</th>
    </thead>
    <tbody>
        @foreach ($company->requirements as $item)
            <tr>
                <td class="d-flex flex-row">
                    <div class="d-flex flex-column user-listing-details px-3">
                        <span>{{ $loop->iteration }}</span>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column user-listing-details px-3">
                        <span>{{ $item->name }}</span>
                    </div>
                </td>
                <td class="user-actions">
                    <a href="{{ route('client.companies.requirements.download', [ $company, $item ]) }}" 
                        class="btn btn-sm btn-outline-info"
                        target="_blank"
                    >
                        <i class="fa fa-download"></i>         
                    </a>

                    {{-- <a href="#" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil"></i>          
                    </a> --}}
                    <button class="btn btn-sm btn-danger btn-delete-requirement" data-requirement="{{ json_encode($item) }}" data-company="{{ json_encode($company) }}">
                        <i class="fa fa-trash"></i>
                    </button> 
                
                </td>
            </tr>
        @endforeach
    </tbody>
</table>