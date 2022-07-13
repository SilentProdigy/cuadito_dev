@extends('layouts.client-main-layout')

@section('content')
<div class="container px-5">
    <div class="my-3">
        <div class="input-group input-group-lg mb-3">
            <input type="text" class="form-control " placeholder="Search Project ...">
            <button class="btn btn-warning" type="button">
                <span class="fa fa-search"></span>
            </button>
        </div>
    </div>

    <section class="mt-4">
        <h4>Projects you might like</h4>

        <div>
            <div class="card my-3">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h5>Project Title</h5>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button type="button" class="btn btn-primary btn-sm">
                                Proposals <span class="badge bg-secondary">4</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-3">
                    <p class="fw-bold fs-6 text-start">
                        <span class="px-1">Company |</span>
                        <span class="px-1">Posted at July 13, 2022 |</span>
                        <span class="px-1">Open till July 31, 2022 </span>
                    </ul>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic amet fugiat sunt aspernatur nihil illo. At pariatur sit, velit eaque inventore qui. Quia nulla qui eveniet dolorem, consequuntur eos iusto repudiandae quam aliquam, similique quidem iure dignissimos at itaque minus alias debitis adipisci. Minus quas ex incidunt mollitia cum reprehenderit et alias ipsam natus dolor. Magni rem sapiente et, aut nostrum porro perspiciatis, provident quas earum, ab eveniet minus. Excepturi, porro recusandae. Quisquam praesentium maiores fugit aspernatur perspiciatis libero culpa laudantium cupiditate labore voluptatem, blanditiis voluptatum minus incidunt porro quis. Officia repellat consequuntur natus voluptatibus magni dignissimos consectetur temporibus. Adipisci?
                    </p>
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-sm btn-outline-success px-3">View</a>
                    </div>
                </div>
              </div>
        </div>
    </section>
</div>
@endsection

@section('script')

@endsection