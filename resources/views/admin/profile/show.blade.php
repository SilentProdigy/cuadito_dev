@extends('layouts.admin-layout')
@section('page_title', $user->name)

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

</style>

@endsection

@section('content')

<div class="container user-profile">
    <div class="card profile-header">
        <div class="card-header image d-flex flex-column px-5">
        </div>
        <div class="card-body position-relative">
            <div class="d-flex align-content-start flex-row gap-4" style="width: 100%">
                <img src="{{ asset('images/avatar/12.png') }}" class="rounded" style="margin-top: -75px; margin-left: 30px;" height="150" width="150" alt="Avatar" />

                <div class="d-flex justify-content-between align-self-start align-content-start flex-grow-1" style="justify-content: space-between; ">
                    <div class="d-flex flex-column">
                        <span class="name text-uppercase">company name</span>
                        <span class="text-sm --text-secondary">Product Developer Company</span>
                    </div>
                    <div class="d-flex align-content-start align-self-start gap-3">
                        <button class="btn text-white" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color: #F96B24;">
                            Edit Company
                        </button>
                        <button class="btn text-white" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color: #6A6A6A;">
                            <i class="fas fa-cog"></i>
                            <span>Account settings</span>
                        </button>
                    </div>
                </div>

            </div>
            <div class="mt-4">
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem facilis, amet sunt veniam itaque nemo!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, et!</p>
            </div>

            <div class="float-end d-flex gap-4">
                <div>
                    @foreach([1,2,3] as $key)
                    <img src="{{ asset('images/avatar/12.png') }}" class="rounded-circle" style="margin-left: -12px;" height="30" width="30" alt="Avatar" />
                    @endforeach
                </div>
                <span>20 Connections</span>
            </div>
        </div>
    </div>


    <div class="my-4">
        <div class="d-flex justify-content-center">
            <ul class="nav nav-tabs d-inline-flex justify-content-center" style="background-color: #efefef;  margin: 0 auto;">
                <li class="nav-item active">
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

        <div class="tab-content">
            <div id="tab1" class="tab-pane fade active ">
                <div class="card p-4">
                    <p>Location</p>

                    <p>
                        19th floor, Marco Polo Ortigas Manila, Sapphire Rd, <br>
                        San Antonio, Pasig, 1600 Metro Manila
                    </p>

                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti soluta ea itaque quisquam temporibus, ipsa nostrum impedit beatae reprehenderit odit incidunt officia tempore, nulla sequi. Aliquam veritatis facilis quasi! Aperiam.</p>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus facilis, doloribus obcaecati rerum corrupti excepturi fugiat nisi minima dicta quas veniam repellat facere? Ipsam, molestiae sequi possimus aperiam nesciunt ea error quod commodi autem eveniet quis quidem. Omnis, adipisci. Optio harum sapiente cum alias nostrum blanditiis dignissimos molestiae enim consectetur voluptatibus, debitis quisquam velit nemo ducimus voluptas omnis aperiam dolore similique, impedit quidem. Eaque officiis enim voluptatibus nesciunt, dicta cum.</p>
                </div>
            </div>

            <div id="tab2" class="tab-pane fade ">
                <div class="card p-4">
                    <nav class="d-flex justify-content-between">
                        <p>Showing 1 to 4 of 20 entries</p>

                        <ul class="d-flex">
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item " style="background-color: #64748b; ">
                                <span class="page-link " style="color: white">
                                    2
                                    <span class="sr-only">(current)</span>
                                </span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>

                    <table>
                        @foreach([1, 2, 3] as $index)
                        <tr>
                            <td class="p-2">
                                <h1 class="text-lg uppercase">Project Title Here</h1>
                                <h3 class="text-base">Project Type: Construction</h3>
                            </td>
                            <td>
                                <h3 class="text-lg uppercase --text-secondary">Project Cost: P 1,000,000.00</h3>
                                <h3 class="text-base --text-secondary">Date: March 30, 2023</h3>
                            </td>
                            <td>
                                <h3 class="text-lg uppercase ">Proposed Cost: P 1,000,000.00</h3>
                                <h3 class="text-base">Date: March 25, 2023</h3>
                            </td>
                            <td>
                                <button class="btn text-white" style="background-color: #F96B24;">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </table>


                </div>
            </div>

            <div id="tab3" class="tab-pane fade ">
                <div class="card p-4">
                    <nav class="d-flex justify-content-between">
                        <p>Showing 1 to 4 of 20 entries</p>

                        <ul class="d-flex">
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item " style="background-color: #64748b; ">
                                <span class="page-link " style="color: white">
                                    2
                                    <span class="sr-only">(current)</span>
                                </span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>


                    <div class="row">
                        @foreach([1, 2, 3, 4, 5, 6] as $key)
                        <div class="p-4 col-6 d-flex gap-4 justify-content-between">
                            <div class="d-flex gap-4 align-items-start">
                                <img src="{{ asset('images/avatar/12.png') }}" style="height: 60px; width: 60px;" />

                                <div class="d-flex flex-column">
                                    <span class="text-base">Company Name</span>
                                    <span>Owner name</span>
                                </div>
                            </div>

                            <button class="btn btn-primary px-4 py-2 align-self-center" style="padding: 10 0; background-color: #00C0EF;">Message</button>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <div id="tab4" class="tab-pane fade ">
                <div class="card p-4">
                    <nav class="d-flex justify-content-between">
                        <p>Showing 1 to 4 of 20 entries</p>

                        <ul class="d-flex">
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item " style="background-color: #64748b; ">
                                <span class="page-link " style="color: white">
                                    2
                                    <span class="sr-only">(current)</span>
                                </span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>

                    @foreach([1, 2, 3] as $key)

                    <section class="border border-2 border-black p-4 mb-5">

                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>XYZ Company</h5>
                                <div class="rating">
                                    <span class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </span>
                                    <span class="rating-value">4.5</span>
                                </div>
                            </div>
                            <span>March 14, 2023</span>
                        </div>

                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos eligendi numquam deleniti quisquam provident doloremque laboriosam possimus harum, suscipit nobis, vero incidunt assumenda saepe fuga voluptates esse odio maiores voluptatum?</p>

                    </section>

                    @endforeach

                </div>
            </div>
        </div>

    </div>


    {{-- <div class="card mt-1">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>About</h5>
            <a href="{{ route('admin.profile.edit', $user) }}" class="btn btn-sm btn-info">Edit Account Info</a>
</div>
<div class="card-body">
    <div class="my-1 py-1">
        <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">NAME</h5>
        <p class="fs-6 lh-lg" style="color: #222;">{{ $user->name }}</p>
    </div>

    <div class="my-1 py-1">
        <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">EMAIL</h5>
        <p class="fs-6 lh-lg" style="color: #222;">{{ $user->email }}</p>
    </div>

    <div class="my-1 py-1">
        <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">ROLE</h5>
        <p class="fs-6 lh-lg" style="color: #222;">{{ $user->role }}</p>
    </div>
</div>
</div> --}}
</div>

<!-- <div class="container-fluid user-profile">
    <div class="card profile-header">
        <div class="card-header image d-flex flex-column px-5">
            <img src="{{ asset('images/avatar/12.png') }}" class="rounded-circle position-absolute" height="150" width="150" alt="Avatar" />
</div>
        <div class="d-flex flex-row">
            <div class="card-body mt-5 mx-3 d-flex flex-column">
                <span class="name mt-3">{{ $user->name }}</span>
                <span>CEO | LOPEZ DIGITAL INDUSTRY</span>
                <span>{{ $user->email }}</span>
            </div>
        </div>
    </div>
    
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Security</h5>
            <a href="{{ route('admin.profile.change-password.form', $user) }}" class="btn btn-sm btn-warning">Change Password</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>About</h5>
            <a href="{{ route('admin.profile.edit', $user) }}" class="btn btn-sm btn-info">Edit Account Info</a>
        </div>
        <div class="card-body">
            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">NAME</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $user->name }}</p>
            </div>

            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">EMAIL</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $user->email }}</p>
            </div>

            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">ROLE</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $user->role }}</p>
            </div>
        </div>
    </div>
</div> -->
@endsection


@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.nav-tabs a').click(function() {
            $(this).tab("show");
        })

        $(".nav-tabs .nav-item:nth-child(1) a").tab("show")
    })

</script>

@endsection
