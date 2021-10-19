@extends('Layout.app')
@section('title',"Profile")
@section('content')

    <div class="container-fluid pt-5">
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{Session::get('avatar')}}" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4>{{Session::get('nickName')}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{Session::get('name')}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{Session::get('email')}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">User ID</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{Session::get('userId')}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Token</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{Session::get('token')}}
                            </div>
                        </div>
                    </div>
                </div>

@endsection