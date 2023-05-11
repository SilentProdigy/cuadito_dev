@extends('layouts.admin-layout')
@section('page_title', 'Clients')

@section('style')
<style>
    :root {
        --primary-color: #F96B23;
        --secondary-color: #666;
    }

    .--text-primary {
        color: var(--primary-color);
    }

    .--text-secondary {
        color: var(--secondary-color);
    }

    .text-xs {
        font-size: 10px;
    }

    .text-sm {
        font-size: 12px;
    }

    .text-base {
        font-size: 16px;
    }

    .text-xl {
        font-size: 24px;
    }

    .tracking-wide {
        letter-spacing: 0.2em;
    }

    .card-reduced-rounded {
        border-radius: 4px !important;
    }

    .card-reduced-shadow {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    table.monthly-earnings tr td {
        padding: 10px;
    }

    table.monthly-earnings tr td:nth-child(2),
    table.monthly-earnings tr td:nth-child(3),
    table.monthly-earnings tr td:nth-child(4) {
        text-align: right;
    }


    table.top-projects tr td {
        padding: 10px;
        font-size: 14px;
    }

</style>
@endsection

@section('content')

<div class="container">

    @php
    $company = $client->companies[0];
    @endphp

    <div class="d-flex justify-content-between">
        <div class="page-title">Users</div>
        <form action="" class="d-flex gap-2 position-relative">
            <div class="position-relative">
                <i class="fas fa-search position-absolute top-4 --text-secondary" style="top: 20%; font-size: 20px; left: 10px;"></i>
                <input type="search" class="form-control bg-white px-4 py-1 " style="border: none; padding-left: 35px !important; ">
            </div>
        </form>
    </div>

    <div class="row mt-4">
        <div class="col-9 pr-4">
            <div class="card p-4">
                <div class="card-body d-flex gap-4">
                    <img src="{{ asset('images/avatar/12.png') }}" style="height: 150px; width: 150px;" class="rounded" />
                    <div class="flex-grow-1 mt-2">
                        <div class="fs-3">{{ $company->name }}</div>

                        <aside class="d-flex " style="width: 100%;">
                            <table class="flex-grow-1">
                                <tr class="">
                                    <td class="fs-6" style="margin-right: 4px;">Address</td>
                                    <td class="--text-secondary text-sm">{{ $company->address }}</td>
                                </tr>
                                <tr class="">
                                    <td class="fs-6 mr-4" style="margin-right: 4px;">Contact</td>
                                    <td class="--text-secondary text-sm">{{ $company->contact_number }}</td>
                                </tr>
                                <tr class="">
                                    <td class="fs-6 mr-4" style="margin-right: 4px;">Email</td>
                                    <td class="--text-secondary text-sm">{{ $company->email }}</td>
                                </tr>
                            </table>

                            <table class="flex-grow-1">
                                <tr class="">
                                    <td class="fs-6" style="margin-right: 4px;">Total Connections</td>
                                    <td class="--text-secondary ">30</td>
                                </tr>
                                <tr class="">
                                    <td class="fs-6 mr-4" style="margin-right: 4px;">Total Projects</td>
                                    <td class="--text-secondary ">{{ $client->projects_count }}</td>
                                </tr>
                                <tr class="">
                                    <td class="fs-6 mr-4" style="margin-right: 4px;">Total Proposals</td>
                                    <td class="--text-secondary ">40</td>
                                </tr>
                            </table>
                        </aside>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-3 pl-4">
            <div class="card" style="background-color: lightgray;">
                <div class="card-body flex-col align-contents-center text-center py-4 pb-5">
                    <div class="fs-4 --text-secondary">Acct Manager</div>
                    <img src="{{ asset($client->profile_picture_url) }}" style="height: 80px; width: 80px;" class="rounded-circle" />
                    <div class="text-base --text-secondary mt-2">{{ $client->name }}</div>
                    <div class="text-base --text-secondary">Marketing Specialist</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-9 pr-4">
            <div class="card p-4">
                <div class="card-body flex p-4">
                    <div>
                        <div class="d-flex justify-content-between w-full" style="width: 100%;">
                            <label for="" class="fs-4">Projects</label>
                            <i class="bx bx-slider-alt fs-5 text-black"></i>

                        </div>

                        <div class="border border-black" style="height: 7em;"></div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between w-full" style="width: 100%;">
                            <label for="" class="fs-4">Proposals Wins</label>
                        </div>

                        <div class="border border-black" style="height: 7em;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 pl-4">
            <div class="card" style="background-color: lightgray;">
                <div class="card-body flex-col align-contents-center text-center py-2">
                    <div class="fs-4 --text-secondary mb-3">Requirements</div>
                    <div class="d-flex justify-content-between">
                        <span class="fs-5 --text-secondary">1pc Picture</span>
                        <button class="btn p-2 py-1 text-white" style="background-color: #6A6A6A;">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span class=" fs-5 --text-secondary">1pc Valid ID (Borrower)</span>
                        <button class="btn p-2 py-1 text-white" style="background-color: #6A6A6A;">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span class="fs-5 --text-secondary">1pc Valid ID (Co-Maker)</span>
                        <button class="btn p-2 py-1 text-white" style="background-color: #6A6A6A;">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span class="fs-5 --text-secondary">Business Permit</span>
                        <button class="btn p-2 py-1 text-white" style="background-color: #6A6A6A;">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
