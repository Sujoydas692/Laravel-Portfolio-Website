@extends('Layout.app')
@section('title',"Home")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{$TotalVisitor}}</h3>
                        <h6 class="count-card-text">Total Visitors</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{$TotalService}}</h3>
                        <h6 class="count-card-text">Total Services</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{$TotalCourse}}</h3>
                        <h6 class="count-card-text">Total Courses</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{$TotalProject}}</h3>
                        <h6 class="count-card-text">Total Projects</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{$TotalContact}}</h3>
                        <h6 class="count-card-text">Total Contacts</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{$TotalReview}}</h3>
                        <h6 class="count-card-text">Total Reviews</h6>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection