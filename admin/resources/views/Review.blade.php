@extends('Layout.app')
@section('title',"Review")
@section('content')
    {{--Review Main Div--}}
    <div id="mainDivReview" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button id="addNewBtnReviewID" class="btn my-3 btn-sm btn-danger"><i class="fas fa-plus"></i>  Add New</button>
                <table id="ReviewDt" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="review_table">





                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{--Review Loader Div--}}
    <div id="loaderDivReview" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="w-50 m-5" src="{{asset('images/loader.gif')}}">

            </div>
        </div>
    </div>

    {{--Review Wrong Div--}}
    <div id="WrongDivReview" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h1><i class="far fa-frown"></i></h1>
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>

    {{--Add Review Modal--}}
    <div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div id="ReviewAddForm" class="w-100">
                        <h6 class="mb-4">Add New Review</h6>
                        <input type="text" id="ReviewNameAddID" class="form-control mb-4" placeholder="Review Name">
                        <input type="text" id="ReviewDesAddID" class="form-control mb-4" placeholder="Review Description">
                        <input type="text" id="ReviewImgAddID" class="form-control mb-4" placeholder="Review Image Link">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="reviewAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Add</button>
                </div>
            </div>
        </div>
    </div>

    {{--Delete Review Modal--}}
    <div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="mt-3">Do you want to delete?</h5>
                    <h5 id="reviewDeleteId" class="mt-4 d-none"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button id="reviewDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

    {{--Edit Review Modal--}}
    <div class="modal fade" id="editReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 id="reviewEditId" class="mt-4 d-none"></h5>
                    <div id="ReviewEditForm" class="d-none w-100">
                        <input type="text" id="ReviewNameEditID" class="form-control mb-4" placeholder="Review Name">
                        <input type="text" id="ReviewDesEditID" class="form-control mb-4" placeholder="Review Description">
                        <input type="text" id="ReviewImgEditID" class="form-control mb-4" placeholder="Review Image Link">
                    </div>
                    <img id="reviewEditLoader" class="w-75 m-5" src="{{asset('images/loader.gif')}}">
                    <h1 id="reviewEditWrongIcon" class="d-none"><i class="far fa-frown"></i></h1>
                    <h5 id="reviewEditWrong" class="d-none">Something Went Wrong!</h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="reviewEditConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">
        getReviewData();

        //For Review Table
        function getReviewData() {
            axios.get('/getReviewData')
                .then(function(response) {

                    if (response.status == 200) {

                        $('#mainDivReview').removeClass('d-none');
                        $('#loaderDivReview').addClass('d-none');

                        $('#ReviewDt').DataTable().destroy();
                        $('#review_table').empty();

                        var dataJSON = response.data;
                        $.each(dataJSON, function(i, item) {
                            $('<tr>').html(
                                "<td>" + dataJSON[i].name + "</td>" +
                                "<td>" + dataJSON[i].des + "</td>" +
                                "<td><a class='reviewEditBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                                "<td><a class='reviewDeleteBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-trash-alt'></i></a></td>"
                            ).appendTo('#review_table');
                        });

                        //For Review Table Delete Icon Click
                        $('.reviewDeleteBtn').click(function() {
                            var id = $(this).data('id');

                            $('#reviewDeleteId').html(id);
                            $('#deleteReviewModal').modal('show');
                        })


                        //Review Table Edit Icon Click
                        $('.reviewEditBtn').click(function() {
                            var id = $(this).data('id');

                            ReviewUpdateDetails(id);

                            $('#reviewEditId').html(id);
                            $('#editReviewModal').modal('show');
                        })

                        //Review Page Table
                        $(document).ready(function() {
                            $('#ReviewDt').DataTable({"order":false});
                            $('.dataTables_length').addClass('bs-select');
                        });

                    } else {
                        $('#loaderDivReview').addClass('d-none');
                        $('#WrongDivReview').removeClass('d-none');
                    }

                }).catch(function(error) {
                $('#loaderDivReview').addClass('d-none');
                $('#WrongDivReview').removeClass('d-none');
            });
        }

        //Review Add New Button Click
        $('#addNewBtnReviewID').click(function () {
            $('#addReviewModal').modal('show');
        });

        //Review Add Method
        function ReviewAdd(reviewName,reviewDes,reviewImg) {

            if(reviewName.length==0){
                toastr.error('Review Name is Empty !');
            }
            else if(reviewDes.length==0){
                toastr.error('Review Description is Empty !');
            }
            else if(reviewImg.length==0){
                toastr.error('Review Image is Empty !');
            }
            else {
                $('#reviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
                axios.post('/ReviewAdd', {
                    name: reviewName,
                    des: reviewDes,
                    img: reviewImg,
                })
                    .then(function(response) {
                        $('#reviewAddConfirmBtn').html("Add");
                        if (response.status==200){
                            if (response.data == 1) {
                                $('#addReviewModal').modal('hide');
                                toastr.success('Add Successful!');
                                getReviewData();
                            } else {
                                $('#addReviewModal').modal('hide');
                                toastr.error('Add Fail!');
                                getReviewData();
                            }
                        } else {
                            $('#addReviewModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#addReviewModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    });
            }
        }

        //Review Add Modal Save Btn
        $('#reviewAddConfirmBtn').click(function() {
            var reviewName = $('#ReviewNameAddID').val();
            var reviewDes = $('#ReviewDesAddID').val();
            var reviewImg = $('#ReviewImgAddID').val();
            ReviewAdd(reviewName,reviewDes,reviewImg)
        })

        //Review Delete Modal Yes Btn
        $('#reviewDeleteConfirmBtn').click(function() {
            var id = $('#reviewDeleteId').html();
            ReviewDelete(id);
        })

        //Review Delete
        function ReviewDelete(deleteID) {

            $('#reviewDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
            axios.post('/ReviewDelete', {
                id: deleteID
            })
                .then(function(response) {
                    $('#reviewDeleteConfirmBtn').html("Yes");
                    if (response.status==200){
                        if (response.data == 1) {
                            $('#deleteReviewModal').modal('hide');
                            toastr.success('Delete Successful!');
                            getReviewData();
                        } else {
                            $('#deleteReviewModal').modal('hide');
                            toastr.error('Delete Fail!');
                            getReviewData();
                        }
                    } else {
                        $('#deleteReviewModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }

                })
                .catch(function(error) {
                    $('#deleteReviewModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                });
        }

        //Each Review Update Details
        function ReviewUpdateDetails(detailsID) {
            axios.post('/ReviewDetails', {
                id: detailsID
            })
                .then(function(response) {
                    if (response.status==200){
                        $('#ReviewEditForm').removeClass('d-none');
                        $('#reviewEditLoader').addClass('d-none');
                        var dataJSON = response.data;
                        $('#ReviewNameEditID').val(dataJSON[0].name);
                        $('#ReviewDesEditID').val(dataJSON[0].des);
                        $('#ReviewImgEditID').val(dataJSON[0].img);
                    }
                    else {
                        $('#reviewEditLoader').addClass('d-none');
                        $('#reviewEditWrong').removeClass('d-none');
                        $('#reviewEditWrongIcon').removeClass('d-none');
                    }
                })
                .catch(function(error) {
                    $('#reviewEditLoader').addClass('d-none');
                    $('#reviewEditWrong').removeClass('d-none');
                    $('#reviewEditWrongIcon').removeClass('d-none');
                });
        }

        //Review Edit Modal Save Btn
        $('#reviewEditConfirmBtn').click(function() {
            var reviewID = $('#reviewEditId').html();
            var reviewName = $('#ReviewNameEditID').val();
            var reviewDes = $('#ReviewDesEditID').val();
            var reviewImg = $('#ReviewImgEditID').val();
            ReviewUpdate(reviewID,reviewName,reviewDes,reviewImg)
        })

        //Review Update Method
        function ReviewUpdate(reviewID,reviewName,reviewDes,reviewImg) {

            if(reviewName.length==0){
                toastr.error('Review Name is Empty !');
            }
            else if(reviewDes.length==0){
                toastr.error('Review Description is Empty !');
            }
            else if(reviewImg.length==0){
                toastr.error('Review Image is Empty !');
            }
            else {
                $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
                axios.post('/ReviewUpdate', {
                    id: reviewID,
                    name: reviewName,
                    des: reviewDes,
                    img: reviewImg,
                })
                    .then(function(response) {
                        $('#reviewEditConfirmBtn').html("Save");
                        if (response.status==200){
                            if (response.data == 1) {
                                $('#editReviewModal').modal('hide');
                                toastr.success('Update Successful!');
                                getReviewData();
                            } else {
                                $('#editReviewModal').modal('hide');
                                toastr.error('Update Fail!');
                                getReviewData();
                            }
                        } else {
                            $('#editReviewModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#editReviewModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    });
            }
        }

    </script>


@endsection