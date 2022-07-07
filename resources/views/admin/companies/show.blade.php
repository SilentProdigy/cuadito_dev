@extends('layouts.dashboard-layout')

@section('content')
<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">{{ $company->name }} Requirements</div>
    </div>
</div>
<div class="card">
    <div class="card-body">
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
                            <a href="{{ route('admin.companies.requirements.download', [ $company, $item ]) }}" 
                                class="btn btn-sm btn-outline-info"
                                target="_blank"
                            >
                                <i class="fa fa-download"></i>         
                            </a>                
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
@endsection