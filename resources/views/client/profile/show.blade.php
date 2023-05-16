@extends('layouts.client-layout')

@section('page_title', $client->name)

@section('style')
    <style>
        :root {
            --primary-color: #F96B23;
            --secondary-color: #666;
        }

        .nav-item .nav-link {
            text-transform: none;
            font-size: 16px;
            padding: 1em 4em;
        }

        .nav-tabs .nav-link.active {
            background-color: white;
            color: #0B0B0D;
            border-bottom: 3px solid #0B0B0D;
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

        .text-lg {
            font-size: 18px;
        }

        .text-xl {
            font-size: 24px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .user-profile .profile-header .card-header {
            /* height: 300px; */
            height: 200px;
            background-image: url("/images/banners/clients_profile_banner.jpg");
            background-size: cover;
        }

        .user-profile .profile-header .card-header img {
            margin-top: 100px;
            border: solid 3px #fff;
        }

        table tr td {
            border: none;
        }

        .nav-item {
            width: 250px;
        }

        .nav-tabs .nav-link.active {
            border-bottom: none;
            text-align: center;
            font-weight: bold;
        }

        .nav-item {
            box-shadow: 2px 2px 4px rgb(175, 172, 172);
        }
    </style>

@endsection

@section('content')

    <div class="container user-profile">
        <div class="card profile-header">
            <div class="card-header image d-flex flex-column px-5">
            </div>
            <div class="card-body position-relative">
                <div class="d-flex align-content-start flex-row gap-4" style="width: 100%">
                    <img src="http://localhost:8000/images/avatar/12.png" class=""
                        style="margin-top: -75px; margin-left: 30px;" alt="Avatar" width="150" height="150">

                    <div class="d-flex justify-content-between align-self-start align-content-start flex-grow-1"
                        style="justify-content: space-between; ">
                        <div class="d-flex flex-column">
                            <span class="name text-uppercase">company name</span>
                            <span class="text-sm --text-secondary">Product Developer Company</span>
                        </div>
                        <div class="d-flex align-content-start align-self-start gap-3">
                            {{-- <button class="btn text-white"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color: #6A6A6A;">
                                Edit Company
                            </button> --}}
                            <a class="btn text-white"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color: #F96B24;"
                                href="{{ url('settings') }}">
                                <i class="fas fa-cog" aria-hidden="true"></i>
                                <span>Account settings</span>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="mt-4" style="margin-left: 30px;">
                    <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem facilis, amet sunt
                        veniam itaque nemo!</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, et!</p>
                </div>

                <div class="float-end d-flex gap-4">
                    <div>
                        <img src="http://localhost:8000/images/avatar/12.png" class="rounded-circle"
                            style="margin-left: -12px;" alt="Avatar" width="30" height="30">
                        <img src="http://localhost:8000/images/avatar/12.png" class="rounded-circle"
                            style="margin-left: -12px;" alt="Avatar" width="30" height="30">
                        <img src="http://localhost:8000/images/avatar/12.png" class="rounded-circle"
                            style="margin-left: -12px;" alt="Avatar" width="30" height="30">
                    </div>
                    <span>20 Connections</span>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <ul class="nav nav-tabs d-inline-flex justify-content-center"
            style="background-color: #efefef;  margin: 0 auto; border: none;">
            <li class="nav-item active text-center">
                <a class="nav-link" data-toggle="tab" href="#tab1">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab2">Wins</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab3">Connections</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab4">Reviews</a>
            </li>
        </ul>
    </div>

    <div class="d-flex justify-content-center">
        <div class="tab-content" style="width: 65%">
            <div id="tab1" class="tab-pane fade active">
                <div class="card p-5">
                    <p>Location</p>

                    <p>
                        19th floor, Marco Polo Ortigas Manila, Sapphire Rd, <br>
                        San Antonio, Pasig, 1600 Metro Manila
                    </p>

                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti soluta ea itaque quisquam
                        temporibus,
                        ipsa nostrum impedit beatae reprehenderit odit incidunt officia tempore, nulla sequi. Aliquam
                        veritatis
                        facilis quasi! Aperiam.</p>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus facilis, doloribus obcaecati
                        rerum corrupti excepturi fugiat nisi minima dicta quas veniam repellat facere? Ipsam, molestiae
                        sequi
                        possimus aperiam nesciunt ea error quod commodi autem eveniet quis quidem. Omnis, adipisci. Optio
                        harum
                        sapiente cum alias nostrum blanditiis dignissimos molestiae enim consectetur voluptatibus, debitis
                        quisquam velit nemo ducimus voluptas omnis aperiam dolore similique, impedit quidem. Eaque officiis
                        enim
                        voluptatibus nesciunt, dicta cum.</p>
                </div>
            </div>

            {{-- wins  --}}
            <div id="tab2" class="tab-pane fade active ">
                <div class="card p-5">

                    <div class="d-flex justify-content-between">
                        <div class="custom-pagination-info"></div>
                        <div class="custom-pagination-paginate"></div>
                    </div>

                    <table class="table" style="border: none;">
                        <tbody style="border: none;">
                            <tr>
                                <td scope="col">
                                    <strong>PROJECT TITLE HERE</strong> <br /> Project Type: Construction
                                </td>
                                <td scope="col">Project Cost: P 1, 000, 000 <br /> Date: March 30, 2023</td>
                                <td scope="col">Proposed Cost: P 1, 000, 000 <br /> Date: March 25, 2023</td>
                                <td scope="col"><i class="fa fa-eye btn btn-orange"></i></td>
                            </tr>
                            <tr>
                                <td scope="col">
                                    <strong>PROJECT TITLE HERE</strong> <br /> Project Type: Construction
                                </td>
                                <td scope="col">Project Cost: P 1, 000, 000 <br /> Date: March 30, 2023</td>
                                <td scope="col">Proposed Cost: P 1, 000, 000 <br /> Date: March 25, 2023</td>
                                <td scope="col"><i class="fa fa-eye btn btn-orange"></i></td>
                            </tr>
                            <tr>
                                <td scope="col">
                                    <strong>PROJECT TITLE HERE</strong> <br /> Project Type: Construction
                                </td>
                                <td scope="col">Project Cost: P 1, 000, 000 <br /> Date: March 30, 2023</td>
                                <td scope="col">Proposed Cost: P 1, 000, 000 <br /> Date: March 25, 2023</td>
                                <td scope="col"><i class="fa fa-eye btn btn-orange"></i></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Connections  --}}
            <div id="tab3" class="tab-pane fade active ">
                <div class="card p-5">

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <img src="http://localhost:8000/images/avatar/12.png" class="rounded"
                                        style="margin-left: 30px;" alt="Avatar" width="100" height="100">
                                </div>
                                <div class="col-lg-5 p-4">
                                    Company Name <br>
                                    Owner Name
                                </div>
                                <div class="col-lg-4 p-4">
                                    <button class="btn btn-blue">Message</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <img src="http://localhost:8000/images/avatar/12.png" class="rounded"
                                        style="margin-left: 30px;" alt="Avatar" width="100" height="100">
                                </div>
                                <div class="col-lg-5 p-4">
                                    Company Name <br>
                                    Owner Name
                                </div>
                                <div class="col-lg-4 p-4">
                                    <button class="btn btn-blue">Message</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <img src="http://localhost:8000/images/avatar/12.png" class="rounded"
                                        style="margin-left: 30px;" alt="Avatar" width="100" height="100">
                                </div>
                                <div class="col-lg-5 p-4">
                                    Company Name <br>
                                    Owner Name
                                </div>
                                <div class="col-lg-4 p-4">
                                    <button class="btn btn-blue">Message</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <img src="http://localhost:8000/images/avatar/12.png" class="rounded"
                                        style="margin-left: 30px;" alt="Avatar" width="100" height="100">
                                </div>
                                <div class="col-lg-5 p-4">
                                    Company Name <br>
                                    Owner Name
                                </div>
                                <div class="col-lg-4 p-4">
                                    <button class="btn btn-blue">Message</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <img src="http://localhost:8000/images/avatar/12.png" class="rounded"
                                        style="margin-left: 30px;" alt="Avatar" width="100" height="100">
                                </div>
                                <div class="col-lg-5 p-4">
                                    Company Name <br>
                                    Owner Name
                                </div>
                                <div class="col-lg-4 p-4">
                                    <button class="btn btn-blue">Message</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <img src="http://localhost:8000/images/avatar/12.png" class="rounded"
                                        style="margin-left: 30px;" alt="Avatar" width="100" height="100">
                                </div>
                                <div class="col-lg-5 p-4">
                                    Company Name <br>
                                    Owner Name
                                </div>
                                <div class="col-lg-4 p-4">
                                    <button class="btn btn-blue">Message</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <img src="http://localhost:8000/images/avatar/12.png" class="rounded"
                                        style="margin-left: 30px;" alt="Avatar" width="100" height="100">
                                </div>
                                <div class="col-lg-5 p-4">
                                    Company Name <br>
                                    Owner Name
                                </div>
                                <div class="col-lg-4 p-4">
                                    <button class="btn btn-blue">Message</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <img src="http://localhost:8000/images/avatar/12.png" class="rounded"
                                        style="margin-left: 30px;" alt="Avatar" width="100" height="100">
                                </div>
                                <div class="col-lg-5 p-4">
                                    Company Name <br>
                                    Owner Name
                                </div>
                                <div class="col-lg-4 p-4">
                                    <button class="btn btn-blue">Message</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <img src="http://localhost:8000/images/avatar/12.png" class="rounded"
                                        style="margin-left: 30px;" alt="Avatar" width="100" height="100">
                                </div>
                                <div class="col-lg-5 p-4">
                                    Company Name <br>
                                    Owner Name
                                </div>
                                <div class="col-lg-4 p-4">
                                    <button class="btn btn-blue">Message</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <img src="http://localhost:8000/images/avatar/12.png" class="rounded"
                                        style="margin-left: 30px;" alt="Avatar" width="100" height="100">
                                </div>
                                <div class="col-lg-5 p-4">
                                    Company Name <br>
                                    Owner Name
                                </div>
                                <div class="col-lg-4 p-4">
                                    <button class="btn btn-blue">Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reviews  --}}
            <div id="tab4" class="tab-pane fade active ">
                <div class="card p-5">
                    <div class="card border p-5 mb-5">
                        <div class="d-flex justify-content-between">
                            <h5>XYZ Company</h5>
                            <p class="ml-auto">March 14, 2023</p>
                        </div>
                        <div class="d-flex justify-content-start">
                            <i class="fa-solid fa-star text-yellow"></i> <i class="fa-solid fa-star text-yellow"></i><i
                                class="fa-solid fa-star text-yellow"></i> <i class="fa-regular fa-star text-yellow"></i>
                            <i class="fa-regular fa-star text-yellow"></i>
                        </div>
                        <div class="d-flex justify-content-start mt-2">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. In mollitia distinctio eaque nisi, ab
                            soluta earum aliquid sed, ullam porro libero iste ratione expedita, harum officiis tempora eius
                            facere illum?
                        </div>
                    </div>
                    <div class="card border p-5 mb-5">
                        <div class="d-flex justify-content-between">
                            <h5>XYZ Company</h5>
                            <p class="ml-auto">March 14, 2023</p>
                        </div>
                        <div class="d-flex justify-content-start">
                            <i class="fa-solid fa-star text-yellow"></i> <i class="fa-solid fa-star text-yellow"></i><i
                                class="fa-solid fa-star text-yellow"></i> <i class="fa-regular fa-star text-yellow"></i>
                            <i class="fa-regular fa-star text-yellow"></i>
                        </div>
                        <div class="d-flex justify-content-start mt-2">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. In mollitia distinctio eaque nisi, ab
                            soluta earum aliquid sed, ullam porro libero iste ratione expedita, harum officiis tempora eius
                            facere illum?
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.nav-tabs a').click(function() {
                $(this).tab("show");
            })

            $(".nav-tabs .nav-item:nth-child(1) a").tab("show");
        })
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
@endsection
