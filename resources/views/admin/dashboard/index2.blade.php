@extends('layouts.admin-layout')
@section('page_title', 'Dashboard')

@section('style')
<link rel="stylesheet" href="/DataTables/datatables.css" />
<style>
    :root {
        --primary-color: #F96B23;
        --secondary-color: #666;
    }

    .--text-primary {
        color: var(--primary-color);
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

    .total-users-card {
        background-image: linear-gradient(#00c0ef, #00c0ef)
    }

    a.paginate_button.current[aria-controls="proposals-table"] {
        background-color: var(--primary-color) !important;
        color: white !important;
        border-color: white !important;
        /*padding: 0.5em 1em !important; */
    }

    .custom-pagination .paginate_button {
        background-color: #FF0000;
        color: #FFF;
        border: none;
        border-radius: 0;
        padding: 8px 12px;
    }

    .custom-pagination .paginate_button:hover {
        background-color: #00FF00;
        color: #000;
    }

    .custom-pagination .paginate_button.current {
        background-color: #0000FF;
        color: #FFF;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: black !important;
        padding: 0 0.5em;
        font-weight: lighter;
        border-radius: 4px;
        font-size: 14px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        font-size: 14px;
        font-weight: normal;
        color: black !important;
    }

</style>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" /> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js" />
@endsection

@section('content')

<div class="container mx-auto">

    <div class="page-breadcrumbs">
        <div class="page-title ">Companies</div>
    </div>

    <nav class="card p-2 mt-4">
        <div class="d-flex gap-4 justify-content-center ">
            <div class="d-flex gap-2 align-items-center">
                <i class="fa-solid fa-envelope"></i>
                <span>Messages (0/20)</span>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <i class="fa-solid fa-bell"></i>
                <span>Alerts</span>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <i class="fa-solid fa-clock"></i>
                <span>9:00 A.M.</span>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <i class="fa-solid fa-calendar"></i>
                <span>March 30, 2023</span>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <i class="fa-solid fa-globe"></i>
                <span>PH (GMT +8)</span>
            </div>
        </div>
    </nav>

    <main class="row mt-4">

        <section class="col-9 d-flex flex-column gap-3">
            <div class="card py-5 d-flex align-items-center flex-column overflow-hidden">
                <img src="{{ url("/images/banners/clients_profile_banner.jpg") }}" class="position-absolute" style="opacity: 0.3; top: 0; right: 0; left: 0; bottom: 0; z-index: 0;" />
                <div style="z-index: 1;">
                    <h1 class="fs-4 --text-primary">Good day, Admin Tony!</h1>
                    <p class="text-sm">How beautiful a day can be, when kindness touches it!</p>
                </div>
            </div>

            <div class="card p-4 px-5">
                <h1 class="fs-5">New Companies</h1>

                <div class="mt-2 d-flex gap-4 justify-content-between align-items-center">

                    <div class="d-flex gap-4 align-items-center">
                        <img src="{{ asset('images/avatar/12.png') }}" class="rounded" height="50" width="50" alt="Avatar" />
                        <div>
                            <h4 class="text-base font-bold mb-0">Company name</h4>
                            <h5 class="text-sm font-bold">Owner Name</h5>
                        </div>
                    </div>

                    <div class="fw-bold">May 1, 2023</div>

                    <div class="fw-bold">Requirements (4/4)</div>

                    <div>
                        <button class="btn btn-black">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-secondary py-1 btn-orange" style="text-transform: none;">
                        <i class="fa-solid fa-eye"></i>
                        <span>View 200 more</span>
                    </button>
                </div>
            </div>

            <div class="card p-4 px-5">
                <h1 class="fs-5">Proposals</h1>

                <section class="mt-4">
                    <table id="proposals-table" class="display " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Project Title</th>
                                <th>Cover Letter</th>
                                <th>Rate</th>
                                <th>Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Company Name</td>
                                <td>Project's title</td>
                                <td>Cover letter</td>
                                <td>9</td>
                                <td>Not paid</td>
                            </tr>

                            <tr>
                                <td>Company Name 2</td>
                                <td>Project's title</td>
                                <td>Cover letter</td>
                                <td>10</td>
                                <td>Paid</td>
                            </tr>

                            @foreach($biddings as $bidding)
                            <tr>
                                <td>{{ $bidding->company->name }}</td>
                                <td>{{ $bidding->project->title }}</td>
                                <td>{{ $bidding->cover_letter }}</td>
                                <td>{{ $bidding->rate }}</td>
                                <td>{{ $bidding->is_paid }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

            </div>

        </section>

        <aside class="col-3 d-flex flex-column gap-3">

            <div class="card py-5 px-4 d-flex  flex-column position-relative " style="background-color: #00c0ef; overflow: hidden;">
                <h3 class="text-sm text-white">Total Users</h3>
                <h1 class="fs-4 text-white">100,520</h1>
                {{-- <h1 class="fs-4 text-white">{{ $users_count }}</h1> --}}
                <i class="fa-solid fa-user position-absolute  fa-2xl" style="color: #00dcf8; font-size: 9em; right: 0; top: 50%; translateY(-50%);"></i>
            </div>

            <div class="card py-5 px-4 d-flex  flex-column position-relative " style="background-color: #f39c12; overflow: hidden;">
                <h3 class="text-sm text-white">Total Projects</h3>
                <h1 class="fs-4 text-white">{{ $projects_count }}</h1>
                <i class="fa-regular fa-note-sticky position-absolute  fa-2xl" style="color: #f9be1b;; font-size: 9em; right: 0; top: 50%; translateY(-50%);"></i>
            </div>

            <div class="card">
                <div class="card-body">
                    <h1 class="fs-4 text-center">Administrators</h1>

                    <section class="d-flex gap-3 mt-4 align-items-center justify-content-between">
                        <img src="{{ asset('images/avatar/12.png') }}" class="rounded-circle " height="60" width="60" alt="Avatar" />
                        <div class="d-flex flex-column flex-grow-1">
                            <span>Name</span>
                            <span>Role</span>
                        </div>
                        <span class="">
                            <i class="fa-solid fa-envelope text-cyan" style="color: #00c0ef; font-size: 1.5em;"></i>
                        </span>
                    </section>
                </div>
            </div>
        </aside>

    </main>
</div>

@endsection

@section("script")
<script src="/DataTables/datatables.js"></script>
<script>
    $(document).ready(function() {
        const table = $("#proposals-table").DataTable({
                "paging": true,
                // "drawCallback": function() {
                //   {{-- var paginationContainer = $($('#proposals-table').table().container()).find('.dataTables_paginate');
                //
                //   console.log($('#proposals-table').table())
                //
                //   var previousButton = $('<button>').text('Previous');
                //   var nextButton = $('<button>').text('Next');
                //
                //   previousButton.on('click', function() {
                //       table.page('previous').draw(false);
                //   });
                //
                //   nextButton.on('click', function() {
                //       table.page('next').draw(false);
                //   });
                //
                //   paginationContainer.empty().append(previousButton, nextButton); --}}
            }
        })

    console.log({
        table
    })


    const paginationButtons = $('.paginate_button'); paginationButtons.addClass('custom-pagination');


    })

</script>

@endsection
