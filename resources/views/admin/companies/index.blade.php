@extends('layouts.admin-layout')
@section('page_title', 'Companies')

@section('style')
<style>
    .right-elements {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .company-cards .card {
        padding: 20px;
        border-radius: 25px;
    }

    .company-name {
        font-size: 24px;
    }

    .company-owner {
        font-size: 20px;
    }

    .page-item.active .page-link {
        background-color: #F96B23;
    }

    .with-action {
        margin-right: 24px;
    }

    .small-counters {
        background-color: #00C0EF;
        border-radius: 100px;
        padding: 5px 6px;
        color: #fff;
        font-size: 10px;
    }

    .status-badge {
        background-color: #00A65A;
        color: #fff;
        font-size: 14px;
        padding: 3px 20px;
        border-radius: 5px;
    }

    .text-sm {
        font-size: 12px;
    }

    #comptabs .nav-link.active {
        color: #fff;
        border: none;
        background-color: #F96B23;
    }

    #comptabs .nav-link {
        padding: 10px 30px
    }

    .page-item.previous-page,
    .page-item.next-page
    {
        display: none;
    }

    .pagination .page-item{
       padding: 0 5px; 
    } 

</style>
@endsection

@section('content')
<div class="container">
    <div class="page-breadcrumbs">
        <div class="page-title">Companies</div>
    </div>

    <div class="d-flex justify-content-between border-bottom border-black mt-4">
            <ul class="nav nav-tabs " id="comptabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ is_null($tab) ? 'active' : null }}" id="comptabs-tab-tab-1" data-mdb-toggle="tab" href="#comptabs-tabs-1" role="tab" aria-controls="comptabs-tabs-1" aria-selected="{{ is_null($tab) }}" data-pagination-name="">New</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == $company_states[1] ? 'active' : null }} " id="comptabs-tab-2" data-mdb-toggle="tab" href="#comptabs-tabs-2" role="tab" aria-controls="comptabs-tabs-2" aria-selected="{{$tab == $company_states[1]}}" data-pagination-name="{{ $company_states[1] }}">Approved</a>
                </li>
                <li class="nav-item " role="presentation">
                    <a class="nav-link {{ $tab == $company_states[0] ? 'active' : null }}" id="comptabs-tab-3" data-mdb-toggle="tab" href="#comptabs-tabs-3" role="tab" aria-controls="comptabs-tabs-3" aria-selected="{{$tab == $company_states[0]}}" data-pagination-name="{{ $company_states[0] }}">Pending</a>
                </li>
                <li class="nav-item " role="presentation">
                    <a class="nav-link {{ $tab == $company_states[2] ? 'active' : null }}" id="comptabs-tab-4" data-mdb-toggle="tab" href="#comptabs-tabs-4" role="tab" aria-controls="comptabs-tabs-4" aria-selected="{{$tab == $company_states[2]}}" data-pagination-name="{{ $company_states[2] }}">Denied</a>
                </li>
            </ul>

        <div class="d-flex gap-3 align-items-center">
            <div class="position-relative align-self-center">
                <i class="fas fa-search position-absolute top-4 --text-secondary" style="top: 20%; font-size: 20px; left: 10px;"></i>
                <input type="search" class="form-control bg-white px-4 py-1 " style="border: none; padding-left: 35px !important; ">
            </div>

            <div class="align-self-center">
                <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#advance-search-modal"><i class="bx bx-slider-alt fs-5 text-black"></i></a>
                @if(request()->has('search') || request()->has('adv_search'))
                <a href="{{ route('admin.companies.index') }}"><i class="bx bx-x"></i></a>
                @endif
            </div>

        </div>
    </div>

    {{-- <div class="d-flex justify-content-between align-items-center mt-2">
        @php
            $perPage = \App\Models\Company::ITEMS_PER_PAGE;
            $page = request("page", 1);
            $totalEntries = $companies->total();
            $firstEntry = ($page - 1) * $perPage + 1;
            $lastEntry = min($firstEntry + $perPage - 1, $totalEntries);
        @endphp

        <div class="pagination-info">
            Showing {{ $firstEntry }} to {{ $lastEntry }} of {{ $totalEntries }} entries
        </div>

        <div>
            <section id="tab-new-pagination" class=" d-flex justify-content-center">
                {{ $companies->links() }}
            </section>

            <section id="tab-approved-pagination" class=" d-flex justify-content-center">
                {{ $approved->links() }}
            </section>

            <section id="tab-pending-pagination" class=" d-flex justify-content-center">
                {{ $pending->links() }}
            </section>

            <section id="tab-disapproved-pagination" class=" d-flex justify-content-center">
                {{ $disapproved->links() }}
            </section>
        </div>
    </div> --}}

    {{-- <hr class="my-0"> --}}

    <div class="container mt-3" id="companies-grid">
        <div class="row">
            <div class="tab-content" id="comptabs-content">
                <div class="tab-pane fade {{ is_null($tab) ? 'show active' : null }}" id="comptabs-tabs-1" role="tabpanel" aria-labelledby="comptabs-tab-1">

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        @php
                            $perPage = \App\Models\Company::ITEMS_PER_PAGE;
                            $page = request("page", 1);
                            $totalEntries = $companies->total();
                            $firstEntry = ($page - 1) * $perPage + 1;
                            $lastEntry = min($firstEntry + $perPage - 1, $totalEntries);
                            // $lastEntry = $firstEntry + $perPage - 1;
                        @endphp

                       @if($totalEntries > 0)
                        <div class="pagination-info">
                            Showing {{ $firstEntry }} to {{ $lastEntry }} of {{ $totalEntries }} entries
                        </div>                       
                       @endif 

                        {{ $companies->links() }}
                    </div>

                    @forelse($companies as $company)
                    <div class="my-4 company-cards">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between">
                                <div class="d-flex gap-3">
                                    <img src="{{ asset('images/avatar/12.png') }}" class="rounded" height="50" width="50" alt="Avatar" />
                                    <h6 class="company-name text-black">{{ $company->name }}</h6>
                                </div>
                                <div>
                                    <h6 class="company-owner text-black">{{ $company->client->name }}</h6>
                                </div>
                                <div>
                                    <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->role == 'admin')
                                        @if($company->validation_status === $company_states[1])
                                            <a href="#" class="btn btn-sm btn-success btn-set-approval-status" data-company="{{ json_encode($company) }}">
                                                <span>Approved</span>
                                            </a>
                                        @elseif($company->validation_status === $company_states[0])
                                            <a href="#" class="btn btn-sm btn-orange btn-set-approval-status" data-company="{{ json_encode($company) }}">
                                                <i class="fa-solid fa-clock"></i>
                                                <span>Pending</span>
                                            </a>
                                        @elseif($company->validation_status === $company_states[2])
                                            <a href="#" class="btn btn-sm btn-black btn-set-approval-status " data-company="{{ json_encode($company) }}">
                                                <i class="fa-solid fa-x"></i>
                                                <span>Denied</span>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-sm btn-orange btn-set-approval-status" data-company="{{ json_encode($company) }}">
                                                Set Approval Status
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="card p-4 d-flex justify-content-center">
                        <span>No data available.</span>
                    </div>
                    @endforelse

                </div>

                <div class="tab-pane fade {{ $tab === $company_states[1] ? 'show active' : null }}" id="comptabs-tabs-2" role="tabpanel" aria-labelledby="comptabs-tab-2">

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        @php
                            $perPage = \App\Models\Company::ITEMS_PER_PAGE;
                            $page = request("page", 1);
                            $totalEntries = $approved->total();
                            $firstEntry = ($page - 1) * $perPage + 1;
                            $lastEntry = min($firstEntry + $perPage - 1, $totalEntries);
                        @endphp

                        @if($totalEntries > 0)
                            <div class="pagination-info">
                                Showing {{ $firstEntry }} to {{ $lastEntry }} of {{ $totalEntries }} entries
                            </div>                       
                        @endif 

                        {{ $approved->links() }}
                    </div>

                    @forelse($approved as $company)
                    <div class="my-4 company-cards">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <h4 class="company-name text-black">{{ $company->name }}</h4>
                                </div>
                                <div>
                                    <h4 class="company-owner text-black">{{ $company->client->name }}</h4>
                                </div>
                                <div>
                                    <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->role == 'admin')
                                    <a href="#" class="btn btn-sm btn-success btn-set-approval-status" data-company="{{ json_encode($company) }}">
                                        <span>Approved</span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="card p-4 d-flex justify-content-center">
                        <span>No data available.</span>
                    </div>
                    @endforelse

                </div>
                <div class="tab-pane fade {{ $tab === $company_states[0] ? 'show active' : null }}" id="comptabs-tabs-3" role="tabpanel" aria-labelledby="comptabs-tab-3">

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        @php
                            $perPage = \App\Models\Company::ITEMS_PER_PAGE;
                            $page = request("page", 1);
                            $totalEntries = $pending->total();
                            $firstEntry = ($page - 1) * $perPage + 1;
                            $lastEntry = min($firstEntry + $perPage - 1, $totalEntries);
                        @endphp

                        @if($totalEntries > 0)
                            <div class="pagination-info">
                                Showing {{ $firstEntry }} to {{ $lastEntry }} of {{ $totalEntries }} entries
                            </div>                       
                        @endif 
                        {{ $pending->links() }}
                    </div>

                    @forelse($pending as $company)
                    <div class="my-4 company-cards">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <h4 class="company-name text-black">{{ $company->name }}</h4>
                                </div>
                                <div>
                                    <h4 class="company-owner text-black">{{ $company->client->name }}</h4>
                                </div>
                                <div>
                                    <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->role == 'admin')
                                    <a href="#" class="btn btn-sm btn-orange btn-set-approval-status" data-company="{{ json_encode($company) }}">
                                        <i class="fa-solid fa-clock"></i>
                                        <span>Pending</span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="card p-4 d-flex justify-content-center">
                        <span>No data available.</span>
                    </div>
                    @endforelse

                </div>

                <div class="tab-pane fade {{ $tab === $company_states[2] ? 'show active' : null }}" id="comptabs-tabs-4" role="tabpanel" aria-labelledby="comptabs-tab-4">
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        @php
                            $perPage = \App\Models\Company::ITEMS_PER_PAGE;
                            $page = request("page", 1);
                            $totalEntries = $disapproved->total();
                            $firstEntry = ($page - 1) * $perPage + 1;
                            $lastEntry = min($firstEntry + $perPage - 1, $totalEntries);
                        @endphp

                        @if($totalEntries > 0)
                            <div class="pagination-info">
                                Showing {{ $firstEntry }} to {{ $lastEntry }} of {{ $totalEntries }} entries
                            </div>                       
                        @endif 
                        {{ $disapproved->links() }}
                    </div>

                    @forelse($disapproved as $company)
                    <div class="my-4 company-cards">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <h4 class="company-name text-black">{{ $company->name }}</h4>
                                </div>
                                <div>
                                    <h4 class="company-owner text-black">{{ $company->client->name }}</h4>
                                </div>
                                <div>
                                    <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->role == 'admin')
                                    <a href="#" class="btn btn-sm btn-black btn-set-approval-status " data-company="{{ json_encode($company) }}">
                                        <i class="fa-solid fa-x"></i>
                                        <span>Denied</span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="card p-4 d-flex justify-content-center">
                            <span>No data available.</span>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>


{{-- <section class="mt-3 d-flex justify-content-center">
    {{ $companies->links() }}
</section> --}}

@include('admin.companies.modals.set_status_modal')
@endsection

@section('script')


<script>
    $(document).ready(function() {
        let set_status_buttons = document.querySelectorAll('.btn-set-approval-status');

        // function waitForElm(selector) {
        //     return new Promise(resolve => {
        //         if (document.querySelector(selector)) {
        //             return resolve(document.querySelector(selector));
        //         }
        //  
        //         const observer = new MutationObserver(mutations => {
        //             if (document.querySelector(selector)) {
        //                 resolve(document.querySelector(selector));
        //                 observer.disconnect();
        //             }
        //         });
        //  
        //         observer.observe(document.body, {
        //             childList: true,
        //             subtree: true
        //         });
        //     });
        // }

        // waitForElm('.previous-page').then((elm) => {
        //     console.log('Element is ready');
        //     console.log(elm.textContent);
        //  
        //     elm.hidden = true
        // });

        // const removeExtraPageButton = () => {
        //     let previous = $(".previous-page");
        //  
        //     console.log({ previous })
        //  
        //     $(".next-page").css({ display: 'hidden'})
        // }


        //  
        // const currentTab = $('.nav-tabs .active').attr('id');
        // console.log('Current tab:', currentTab);
        //  

        const setPagination = (_currentTab = null) => {
            const urlParams = new URLSearchParams(window.location.search);
            const currentTab = _currentTab ?? urlParams.get('tab');

            let tabNewPagination = $("#tab-new-pagination");
            let tabApprovedPagination = $("#tab-approved-pagination");
            let tabPendingPagination = $("#tab-pending-pagination");
            let tabDisapprovedPagination = $("#tab-disapproved-pagination");

            const tabPagination = [tabNewPagination, tabApprovedPagination, tabPendingPagination, tabDisapprovedPagination]
 
            for(pagination of tabPagination)
                pagination.removeClass("d-flex").addClass("d-none");

            if (!currentTab) tabNewPagination.removeClass("d-none").addClass('d-flex');
            else if (currentTab === 'APPROVED') tabApprovedPagination.removeClass("d-none").addClass('d-flex');
            else if (currentTab === 'FOR APPROVAL') tabPendingPagination.removeClass("d-none").addClass('d-flex');
            else if (currentTab === 'DISAPPROVED') tabDisapprovedPagination.removeClass("d-none").addClass('d-flex');
        }

        $('.nav-link').on('click', function() {
            var clickedTab = $(this).attr('id');
            console.log('Clicked tab:', clickedTab);

            setPagination($(this).attr("data-pagination-name"))
        });

        setPagination()

        set_status_buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                let data = button.getAttribute('data-company');
                data = JSON.parse(data);

                let myModal = new bootstrap.Modal(document.getElementById('set-company-status-modal'), {
                    keyboard: false
                })
                myModal.show()

                let form = document.querySelector('#set-company-status-form');
                form.setAttribute('action', `/admin/companies/${ data.id }`);

                // console.log(data);
                $('#validation_status').val(`${ data.validation_status }`);

                if (data.validation_status === 'DISAPPROVED') {
                    $('#remarks-text-area').show();
                    $('#remarks-text-area').val(data.remarks);
                }

                $('#validation_status').on('change', function(e) {
                    // console.log("validation_status: ", $(this).val());
                    const selected_value = $(this).val();
                    selected_value === "DISAPPROVED" ? $('#remarks-text-area').show() : $('#remarks-text-area').hide();
                });
            });
        });

        $('#btn-update-status').on('click', function(e) {
            e.preventDefault();

            const selected_value = $('#validation_status').val();

            if (selected_value === "DISAPPROVED") {
                const remarks = $('#remarks-text-area').val();

                if (!remarks) {
                    alert("Remarks field is required!");
                    return;
                }
            }

            $('#set-company-status-form').submit();
        });


        removeExtraPageButton()

    });

</script>
@endsection
