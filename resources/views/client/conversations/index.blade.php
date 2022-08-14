@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Inbox</div>
        <div class="col d-flex justify-content-end">
            <a href="#" class="btn btn-warning header-btn">
                <i class="fa fa-plus"></i>&ensp;New Email
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @foreach ($conversations as $item)
            <div class="border-top border-3 py-4">
                <div class="d-flex flex-row d-align-items-center justify-content-between">
                    <h3>`</h3>
                    <p>Aug. 14, 2022</p>
                </div>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque inventore distinctio repellendus, 
                    suscipit consectetur dicta eveniet libero. Esse earum porro iure. Iusto beatae quod ullam, ipsa est earum ex quasi.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloribus, aliquid.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloribus, aliquid.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloribus, aliquid.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloribus, aliquid.
                </p>
            </div>
        @endforeach        
    </div>
</div>

@endsection

@section('script')
   
@endsection