@extends('Layout.app')

@section('content')

    {{--Service Main Div--}}
    <div id="mainDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button id="addNewBtnID" class="btn my-3 btn-sm btn-danger"><i class="fas fa-plus"></i>  Add New</button>
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

    {{--Service Loader Div--}}
    <div id="loaderDiv" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="w-50 m-5" src="{{asset('images/loader.gif')}}">

            </div>
        </div>
    </div>

    {{--Service Wrong Div--}}
    <div id="WrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h1><i class="far fa-frown"></i></h1>
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>

     {{--Delete Service Modal--}}
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

    {{--Edit Service Modal--}}
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

    {{--Add Service Modal--}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div id="ServiceAddForm" class="w-100">
                        <h6 class="mb-4">Add New Service</h6>
                        <input type="text" id="ServiceNameAddID" class="form-control mb-4" placeholder="Service Name">
                        <input type="text" id="ServiceDesAddID" class="form-control mb-4" placeholder="Service Description">
                        <input type="text" id="ServiceImgAddID" class="form-control mb-4" placeholder="Service Image Link">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="serviceAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Add</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        getServicesData();

        //For Services Table
        function getServicesData() {
            axios.get('/getServicesData')
                .then(function(response) {

                    if (response.status == 200) {

                        $('#mainDiv').removeClass('d-none');
                        $('#loaderDiv').addClass('d-none');

                        $('#service_table').empty();

                        var dataJSON = response.data;
                        $.each(dataJSON, function(i, item) {
                            $('<tr>').html(
                                "<td><img class='table-img' src=" + dataJSON[i].service_img + "></td>" +
                                "<td>" + dataJSON[i].service_name + "</td>" +
                                "<td>" + dataJSON[i].service_des + "</td>" +
                                "<td><a class='serviceEditBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                                "<td><a class='serviceDeleteBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-trash-alt'></i></a></td>"
                            ).appendTo('#service_table');
                        });

                        //For Services Table Delete Icon Click
                        $('.serviceDeleteBtn').click(function() {
                            var id = $(this).data('id');

                            $('#serviceDeleteId').html(id);
                            $('#deleteModal').modal('show');
                        })


                        //Services Table Edit Icon Click
                        $('.serviceEditBtn').click(function() {
                            var id = $(this).data('id');

                            ServiceUpdateDetails(id);

                            $('#serviceEditId').html(id);
                            $('#editModal').modal('show');
                        })

                    } else {
                        $('#loaderDiv').addClass('d-none');
                        $('#WrongDiv').removeClass('d-none');
                    }

                }).catch(function(error) {
                $('#loaderDiv').addClass('d-none');
                $('#WrongDiv').removeClass('d-none');
            });
        }

        //Services Delete Modal Yes Btn
        $('#serviceDeleteConfirmBtn').click(function() {
            var id = $('#serviceDeleteId').html();
            ServiceDelete(id);
        })

        //Service Delete
        function ServiceDelete(deleteID) {

            $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
            axios.post('/ServiceDelete', {
                id: deleteID
            })
                .then(function(response) {
                    $('#serviceDeleteConfirmBtn').html("Yes");
                    if (response.status==200){
                        if (response.data == 1) {
                            $('#deleteModal').modal('hide');
                            toastr.success('Delete Successful!');
                            getServicesData();
                        } else {
                            $('#deleteModal').modal('hide');
                            toastr.error('Delete Fail!');
                            getServicesData();
                        }
                    } else {
                        $('#deleteModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }

                })
                .catch(function(error) {
                    $('#deleteModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                });
        }

        //Each Service Update Details
        function ServiceUpdateDetails(detailsID) {
            axios.post('/ServiceDetails', {
                id: detailsID
            })
                .then(function(response) {
                    if (response.status==200){
                        $('#ServiceEditForm').removeClass('d-none');
                        $('#serviceEditLoader').addClass('d-none');
                        var dataJSON = response.data;
                        $('#ServiceNameID').val(dataJSON[0].service_name);
                        $('#ServiceDesID').val(dataJSON[0].service_des);
                        $('#ServiceImgID').val(dataJSON[0].service_img);
                    }
                    else {
                        $('#serviceEditLoader').addClass('d-none');
                        $('#serviceEditWrong').removeClass('d-none');
                        $('#serviceEditWrongIcon').removeClass('d-none');
                    }
                })
                .catch(function(error) {
                    $('#serviceEditLoader').addClass('d-none');
                    $('#serviceEditWrong').removeClass('d-none');
                    $('#serviceEditWrongIcon').removeClass('d-none');
                });
        }

        //Services Edit Modal Save Btn
        $('#serviceEditConfirmBtn').click(function() {
            var id = $('#serviceEditId').html();
            var name = $('#ServiceNameID').val();
            var des = $('#ServiceDesID').val();
            var img = $('#ServiceImgID').val();
            ServiceUpdate(id,name,des,img)
        })

        //Service Update Method
        function ServiceUpdate(serviceID,serviceName,serviceDes,serviceImg) {

            if(serviceName.length==0){
                toastr.error('Service Name is Empty !');
            }
            else if(serviceDes.length==0){
                toastr.error('Service Description is Empty !');
            }
            else if(serviceImg.length==0){
                toastr.error('Service Image is Empty !');
            }
            else {
                $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
                axios.post('/ServiceUpdate', {
                    id: serviceID,
                    service_name: serviceName,
                    service_des: serviceDes,
                    service_img: serviceImg,
                })
                    .then(function(response) {
                        $('#serviceEditConfirmBtn').html("Save");
                        if (response.status==200){
                            if (response.data == 1) {
                                $('#editModal').modal('hide');
                                toastr.success('Update Successful!');
                                getServicesData();
                            } else {
                                $('#editModal').modal('hide');
                                toastr.error('Update Fail!');
                                getServicesData();
                            }
                        } else {
                            $('#editModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#editModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    });
            }
        }

        //Service Add New Button Click
        $('#addNewBtnID').click(function () {
            $('#addModal').modal('show');
        });

        //Service Add Method
        function ServiceAdd(serviceName,serviceDes,serviceImg) {

            if(serviceName.length==0){
                toastr.error('Service Name is Empty !');
            }
            else if(serviceDes.length==0){
                toastr.error('Service Description is Empty !');
            }
            else if(serviceImg.length==0){
                toastr.error('Service Image is Empty !');
            }
            else {
                $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
                axios.post('/ServiceAdd', {
                    service_name: serviceName,
                    service_des: serviceDes,
                    service_img: serviceImg,
                })
                    .then(function(response) {
                        $('#serviceAddConfirmBtn').html("Add");
                        if (response.status==200){
                            if (response.data == 1) {
                                $('#addModal').modal('hide');
                                toastr.success('Add Successful!');
                                getServicesData();
                            } else {
                                $('#addModal').modal('hide');
                                toastr.error('Add Fail!');
                                getServicesData();
                            }
                        } else {
                            $('#addModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#addModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    });
            }
        }

        //Services Add Modal Save Btn
        $('#serviceAddConfirmBtn').click(function() {
            var name = $('#ServiceNameAddID').val();
            var des = $('#ServiceDesAddID').val();
            var img = $('#ServiceImgAddID').val();
            ServiceAdd(name,des,img)
        })
    </script>


@endsection