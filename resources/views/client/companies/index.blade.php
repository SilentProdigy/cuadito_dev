@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Your Companies</div>
        <div class="col d-flex justify-content-end">
            <a href="{{ route('client.companies.create') }}" class="btn btn-primary header-btn">
                <i class="fa fa-plus"></i>&ensp;Add Company
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table">
            <thead>
                <th>SEQ</th>
                <th>COMPANY</th>
                <th class="col-span-2">STATUS</th>
                <th>SUBSCRIPTION</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td class="d-flex flex-row">
                        <div class="d-flex flex-column user-listing-details px-3">
                            <span>{{ $loop->iteration }}</span>
                        </div>
                    </td>
                    <td>
                        <span>{{ $company->name }}</span>
                    </td>
                    <td class="">
                        <span>{{ $company->validation_status }}</span>
                    </td>
                    <td>
                       <span>-</span>
                    </td>
                    <td class="user-actions">
                        <a href="#" class="btn btn-sm btn-outline-info">
                            <i class="fa fa-eye"></i>         
                        </a>
                        <a href="{{ route('client.companies.edit', $company) }}" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil"></i>          
                        </a>
                        <a href="#" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
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