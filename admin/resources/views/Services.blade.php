@extends('Layout.app')

@section('content')

    <div id="mainDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Image</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="service_table">





                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div id="loaderDiv" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="w-50 m-5" src="{{asset('images/loader.gif')}}">

            </div>
        </div>
    </div>

    <div id="WrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h1><i class="far fa-frown"></i></h1>
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="mt-4">Do you want to delete?</h5>
                    <h5 id="serviceDeleteId" class="mt-4"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button id="serviceDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 id="serviceEditId" class="mt-4"></h5>
                    <div id="ServiceEditForm" class="d-none w-100">
                        <input type="text" id="ServiceNameID" class="form-control mb-4" placeholder="Service Name">
                        <input type="text" id="ServiceDesID" class="form-control mb-4" placeholder="Service Description">
                        <input type="text" id="ServiceImgID" class="form-control mb-4" placeholder="Service Image Link">
                    </div>
                        <img id="serviceEditLoader" class="w-75 m-5" src="{{asset('images/loader.gif')}}">
                        <h1 id="serviceEditWrongIcon" class="d-none"><i class="far fa-frown"></i></h1>
                        <h5 id="serviceEditWrong" class="d-none">Something Went Wrong!</h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="serviceEditConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        getServicesData();
    </script>


@endsection