@extends('layouts.client-layout')

@section('page_title', 'Account Settings')

@section('style')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
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
            border-bottom: none;
            text-align: center;
            font-weight: bold;
        }

        .--text-secondary {
            color: var(--secondary-color);
        }

        .text-xl {
            font-size: 30px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .nav-item {
            width: 232px !important;
            box-shadow: 2px 2px 4px rgb(175, 172, 172);
        }

        .card {
            border-radius: 0 !important;
        }

        .toggle.ios,
        .toggle-on.ios,
        .toggle-off.ios {
            border-radius: 20px;
        }

        .toggle.ios .toggle-handle {
            border-radius: 20px;
            background-color: white;
        }

        #ppp {
            position: absolute;
            bottom: 0;
            right: 40%;
            font-size: .75rem;
        }

        table,
        thead,
        tbody {
            border-color: transparent !important;
            font-size: 1rem;
        }

        tbody tr {
            background-color: #E6E7E7 !important;
            margin-bottom: 20px !important;
            align-items: center !important;
            font-weight: bolder;
        }

        table {
            border-collapse: separate;
            border-spacing: 0 20px;
        }
    </style>
@endsection

@section('content')


    <div class="d-flex justify-ceontent-center mt-5">
        <div class="container">
            <p class="text-xl">Account Settings</p>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <ul class="nav nav-tabs d-inline-flex justify-content-center" style="background-color: #efefef;  margin: 0 auto;">
            <li class="nav-item active text-center">
                <a class="nav-link" data-toggle="tab" href="#tab1">Your Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab2">Company</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab3">Login & Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab4">Payment History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab5">Analytics</a>
            </li>
        </ul>
    </div>

    <div class="d-flex justify-content-center">
        <div class="tab-content" style="width: 65%;">

            {{-- your account  --}}
            <div id="tab1" class="tab-pane fade active">
                <div class="card p-5">
                    <div class="mt-2">
                        <p>
                            Name
                        </p>
                        <p>
                            John Doe
                        </p>
                    </div>

                    <div class="mt-2">
                        <p>
                            Email
                        </p>
                        <p>
                            amlcorporation@gmail.com
                        </p>
                    </div>
                    <div class="mt-2">
                        <p>
                            Address
                        </p>
                        <p>
                            Bicol Region, Philippines 4500
                        </p>
                    </div>
                </div>
            </div>

            {{-- Company  --}}
            <div id="tab2" class="tab-pane fade active ">
                <div class="card p-5">
                    <div class="d-flex justify-content-between p-2" style="border-bottom: 1.5px solid rgb(175, 173, 173);">
                        <div>
                            <img src="http://localhost:8000/images/avatar/12.png" class="" style=" margin-left: 30px;"
                                alt="Avatar" width="150" height="150">
                        </div>
                        <div class="mt-5">
                            <button class="btn text-white p-2 btn-lg"
                                style="--bs-btn-padding-y: .30rem; --bs-btn-padding-x: .10rem; font-size: 1rem; background-color: #6A6A6A; text-transform: none; width: 100px;">
                                Edit
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between p-2" style="border-bottom: 1.5px solid rgb(175, 173, 173);">
                        <div class="mt-3 p-2">
                            <div>Name</div> 1MC Digital, Inc.
                        </div>
                        <div class="mt-4">
                            <button class="btn text-white p-2 btn-lg"
                                style="--bs-btn-padding-y: .30rem; --bs-btn-padding-x: .10rem; font-size: 1rem; background-color: #6A6A6A; text-transform: none; width: 100px;">
                                Edit
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between p-2" style="border-bottom: 1.5px solid rgb(175, 173, 173);">
                        <div class="mt-3 p-2">
                            <div>Email</div> amlcorporation@gmail.com
                        </div>
                        <div class="mt-4">
                            <button class="btn text-white p-2 btn-lg"
                                style="--bs-btn-padding-y: .30rem; --bs-btn-padding-x: .10rem; font-size: 1rem; background-color: #6A6A6A; text-transform: none; width: 100px;">
                                Edit
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between p-2" style="border-bottom: 1.5px solid rgb(175, 173, 173);">
                        <div class="mt-3 p-2">
                            <div>Address</div> NCR, Philippines 0001
                        </div>
                        <div class="mt-4">
                            <button class="btn text-white p-2 btn-lg"
                                style="--bs-btn-padding-y: .30rem; --bs-btn-padding-x: .10rem; font-size: 1rem; background-color: #6A6A6A; text-transform: none; width: 100px;">
                                Edit
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Connections  --}}
            <div id="tab3" class="tab-pane fade active ">
                <div class="card p-5">

                    <p class="text-muted">
                        Settings and recommendation to help keep your account secure
                    </p>

                    <div style="width: 70%;">

                        <div class="d-flex justify-content-between p-2"
                            style="border-bottom: 1.5px solid rgb(175, 173, 173);">
                            <div class="mt-3 p-2">
                                <div>Password</div> **********
                            </div>
                            <div class="mt-4">
                                <button class="btn text-white p-2 btn-lg"
                                    style="--bs-btn-padding-y: .30rem; --bs-btn-padding-x: .10rem; font-size: 1rem; background-color: #6A6A6A; text-transform: none; width: 100px;">
                                    Edit
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between p-2"
                            style="border-bottom: 1.5px solid rgb(175, 173, 173);">
                            <div class="mt-3 p-2">
                                <div>Recovery Email</div> amlcorporation@gmail.com
                            </div>
                            <div class="mt-4">
                                <button class="btn text-white p-2 btn-lg"
                                    style="--bs-btn-padding-y: .30rem; --bs-btn-padding-x: .10rem; font-size: 1rem; background-color: #6A6A6A; text-transform: none; width: 100px;">
                                    Edit
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between p-2"
                            style="border-bottom: 1.5px solid rgb(175, 173, 173);">
                            <div class="mt-3 p-2">
                                2-Step Verification
                            </div>
                            <div class="mt-4">
                                <input type="checkbox" checked data-toggle="toggle" data-style="ios" data-onstyle="success"
                                    data-on="&nbsp;" data-off="&nbsp;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between p-2"
                            style="border-bottom: 1.5px solid rgb(175, 173, 173);">
                            <div class="mt-3 p-2">
                                Phone Number <br> 09255458561
                            </div>
                            <div class="mt-4">
                                <button class="btn text-white p-2 btn-lg"
                                    style="--bs-btn-padding-y: .30rem; --bs-btn-padding-x: .10rem; font-size: 1rem; background-color: #6A6A6A; text-transform: none; width: 100px;">
                                    Edit
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Payment History  --}}
            <div id="tab4" class="tab-pane fade active ">
                <div class="card p-5">

                    <h4 class="ml-2">Payment History</h4>

                    <table class="table mb-4">
                        <thead>
                            <tr class="text-muted">
                                <th>Invoice #</th>
                                <th>Partner</th>
                                <th>Status</th>
                                <th>Total Cost</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Company Name</td>
                                <td>Processing</td>
                                <td>P20, 000</td>
                                <td><button class="btn btn-orange"><i class="fa fa-eye text-white"></i></button></td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Company Name</td>
                                <td>Processing</td>
                                <td>P20, 000</td>
                                <td><button class="btn btn-orange"><i class="fa fa-eye text-white"></i></button></td>
                            </tr>
                            <tr>
                                <td>0003</td>
                                <td>Company Name</td>
                                <td>Done</td>
                                <td>P20, 000</td>
                                <td><button class="btn btn-orange"><i class="fa fa-eye text-white"></i></button></td>
                            </tr>
                            <tr>
                                <td>0004</td>
                                <td>Company Name</td>
                                <td>Cancelled</td>
                                <td>P20, 000</td>
                                <td><button class="btn btn-orange"><i class="fa fa-eye text-white"></i></button></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <div class="mt-5 mb-3" id="ppp">
                            Learn more about &nbsp;
                            <a class="text-blue">Payment Process Policy</a>.
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
        });
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection
