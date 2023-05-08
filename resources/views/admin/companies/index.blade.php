@extends('layouts.admin-layout')
@section('page_title', 'Companies')

@section('style')
<style>
    .right-elements{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .company-cards .card{padding: 20px; border-radius: 25px;}
    .company-name{font-size: 24px;}
    .company-owner{font-size: 20px; }
    .page-item.active .page-link{background-color: #F96B23;}
    .with-action{margin-right: 24px;}
    .small-counters{background-color: #00C0EF; border-radius: 100px; padding: 5px 6px; color: #fff; font-size: 10px;}
    .status-badge{background-color: #00A65A; color: #fff; font-size: 14px; padding: 3px 20px;
    border-radius: 5px;}
    #comptabs .nav-link.active{color: #fff; border: none; background-color: #F96B23;}
    #comptabs .nav-link{padding: 10px 30px}
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-breadcrumbs">
        <div class="page-title">Companies</div>
        <div class="right-elements">
            <div>
                <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#advance-search-modal"><i class="bx bx-slider-alt fs-5 text-black"></i></a>
                @if(request()->has('search') || request()->has('adv_search'))
                    <a href="{{ route('admin.companies.index') }}"><i class="bx bx-x"></i></a>
                @endif
            </div>
        </div>
    </div>
    <hr>

    <div class="d-flex justify-content-between">
        <div>
            <ul class="nav nav-tabs mb-3" id="comptabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link active"
                    id="comptabs-tab-tab-1"
                    data-mdb-toggle="tab"
                    href="#comptabs-tabs-1"
                    role="tab"
                    aria-controls="comptabs-tabs-1"
                    aria-selected="true"
                    >New</a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link"
                    id="comptabs-tab-2"
                    data-mdb-toggle="tab"
                    href="#comptabs-tabs-2"
                    role="tab"
                    aria-controls="comptabs-tabs-2"
                    aria-selected="false"
                    >Approved</a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link"
                    id="comptabs-tab-3"
                    data-mdb-toggle="tab"
                    href="#comptabs-tabs-3"
                    role="tab"
                    aria-controls="comptabs-tabs-3"
                    aria-selected="false"
                    >Pending</a
                  >
                </li>
                <li class="nav-item" role="presentation">
                    <a
                      class="nav-link"
                      id="comptabs-tab-4"
                      data-mdb-toggle="tab"
                      href="#comptabs-tabs-4"
                      role="tab"
                      aria-controls="comptabs-tabs-4"
                      aria-selected="false"
                      >Denied</a
                    >
                  </li>
              </ul>
        </div>
        <div>
            <div class="pagination">
                <!--<li class="page-item previous-page disable"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item current-page active"><a class="page-link" href="#">1</a></li>
                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
                <li class="page-item next-page"><a class="page-link" href="#">Next</a></li>-->
            </div>
        </div>
    </div>

    <div class="container mt-3" id="companies-grid">
        <div class="row">
            <div class="tab-content" id="comptabs-content">
                <div
                  class="tab-pane fade show active"
                  id="comptabs-tabs-1"
                  role="tabpanel"
                  aria-labelledby="comptabs-tab-1"
                >
                @foreach($companies as $company)
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
                                        Set Approval Status
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
                <div class="tab-pane fade" id="comptabs-tabs-2" role="tabpanel" aria-labelledby="comptabs-tab-2">
                  Tab 2 content
                </div>
                <div class="tab-pane fade" id="comptabs-tabs-3" role="tabpanel" aria-labelledby="comptabs-tab-3">
                  Tab 3 content
                </div>
            </div>
        </div>
    </div>
</div>

    <section class="mt-3 d-flex justify-content-center">
        {{ $companies->links() }}
    </section>

    @include('admin.companies.modals.set_status_modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let set_status_buttons = document.querySelectorAll('.btn-set-approval-status');

        set_status_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-company');   
                data = JSON.parse(data);

                let myModal = new bootstrap.Modal(document.getElementById('set-company-status-modal'), {keyboard: false})
                myModal.show()

                let form = document.querySelector('#set-company-status-form');
                form.setAttribute('action', `/admin/companies/${ data.id }`);

                // console.log(data);
                $('#validation_status').val(`${ data.validation_status }`);

                if(data.validation_status === 'DISAPPROVED') {
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

            if(selected_value === "DISAPPROVED")
            {
                const remarks = $('#remarks-text-area').val();

                if(!remarks) {
                    alert("Remarks field is required!");
                    return;
                }
            }

            $('#set-company-status-form').submit();
        });

    });
</script>
@endsection