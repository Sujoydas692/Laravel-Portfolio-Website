@extends('Layout.app')
@section('title',"Courses")
@section('content')


    {{--Course Main Div--}}
    <div id="mainDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button id="addNewCourseBtnID" class="btn my-3 btn-sm btn-danger"><i class="fas fa-plus"></i>  Add New</button>
                <table id="CourseDt" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Course Name</th>
                        <th class="th-sm">Course Fee</th>
                        <th class="th-sm">Total Class</th>
                        <th class="th-sm">Total Enroll</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="course_table">





                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{--Course Loader Div--}}
    <div id="loaderDivCourse" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="w-50 m-5" src="{{asset('images/loader.gif')}}">

            </div>
        </div>
    </div>

    {{--Course Wrong Div--}}
    <div id="WrongDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h1><i class="far fa-frown"></i></h1>
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>

    {{--Add Course Modal--}}
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
                                <input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
                                <input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
                                <input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
                            </div>
                            <div class="col-md-6">
                                <input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
                                <input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
                                <input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add</button>
                </div>
            </div>
        </div>
    </div>

    {{--Delete Course Modal--}}
    <div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <h5 id="CourseDeleteId" class="mt-4 d-none"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button id="CourseDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

    {{--Edit Course Modal--}}
    <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <h5 id="CourseEditId" class="mt-4 d-none"></h5>
                    <div id="CourseEditForm" class="container d-none">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="CourseNameEditId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
                                <input id="CourseDesEditId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
                                <input id="CourseFeeEditId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
                                <input id="CourseEnrollEditId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
                            </div>
                            <div class="col-md-6">
                                <input id="CourseClassEditId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
                                <input id="CourseLinkEditId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
                                <input id="CourseImgEditId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
                            </div>
                        </div>
                    </div>
                    <img id="CourseEditLoader" class="w-75 m-5" src="{{asset('images/loader.gif')}}">
                    <h1 id="CourseEditWrongIcon" class="d-none"><i class="far fa-frown"></i></h1>
                    <h5 id="CourseEditWrong" class="d-none">Something Went Wrong!</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="CourseEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('script')

    <script type="text/javascript">
        getCoursesData();

        //For Courses Table
        function getCoursesData() {
            axios.get('/getCoursesData')
                .then(function(response) {

                    if (response.status == 200) {

                        $('#mainDivCourse').removeClass('d-none');
                        $('#loaderDivCourse').addClass('d-none');

                        $('#CourseDt').DataTable().destroy();
                        $('#course_table').empty();

                        var dataJSON = response.data;
                        $.each(dataJSON, function(i, item) {
                            $('<tr>').html(
                                "<td>" + dataJSON[i].course_name + "</td>" +
                                "<td>" + dataJSON[i].course_fee + "</td>" +
                                "<td>" + dataJSON[i].course_totalclass + "</td>" +
                                "<td>" + dataJSON[i].course_totalenroll + "</td>" +
                                "<td><a class='courseEditBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                                "<td><a class='courseDeleteBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-trash-alt'></i></a></td>"
                            ).appendTo('#course_table');
                        });

                        //For Course Table Delete Icon Click
                        $('.courseDeleteBtn').click(function() {

                            var id = $(this).data('id');
                            $('#CourseDeleteId').html(id);

                            $('#deleteCourseModal').modal('show');
                        })

                        //Course Table Edit Icon Click
                        $('.courseEditBtn').click(function() {

                            var id = $(this).data('id');
                            CourseUpdateDetails(id);

                            $('#CourseEditId').html(id);
                            $('#editCourseModal').modal('show');
                        })

                        //Course Page Table
                        $(document).ready(function() {
                            $('#CourseDt').DataTable({"order":false});
                            $('.dataTables_length').addClass('bs-select');
                        });

                    } else {
                        $('#loaderDivCourse').addClass('d-none');
                        $('#WrongDivCourse').removeClass('d-none');
                    }

                }).catch(function(error) {
                $('#loaderDivCourse').addClass('d-none');
                $('#WrongDivCourse').removeClass('d-none');
            });
        }

        //Course Add Button Click
        $('#addNewCourseBtnID').click(function () {
            $('#addCourseModal').modal('show');
        });

        //Course Add Method
        function CourseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg) {

            if(CourseName.length==0){
                toastr.error('Course Name is Empty !');
            }
            else if(CourseDes.length==0){
                toastr.error('Course Description is Empty !');
            }
            else if(CourseFee.length==0){
                toastr.error('Course Fee is Empty !');
            }
            else if(CourseEnroll.length==0){
                toastr.error('Course Enroll is Empty !');
            }
            else if(CourseClass.length==0){
                toastr.error('Course Class is Empty !');
            }
            else if(CourseLink.length==0){
                toastr.error('Course Link is Empty !');
            }
            else if(CourseImg.length==0){
                toastr.error('Course Image is Empty !');
            }
            else {
                $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
                axios.post('/CourseAdd', {
                    course_name: CourseName,
                    course_des: CourseDes,
                    course_fee: CourseFee,
                    course_totalenroll: CourseEnroll,
                    course_totalclass: CourseClass,
                    course_link: CourseLink,
                    course_img: CourseImg,
                })
                    .then(function(response) {
                        $('#CourseAddConfirmBtn').html("Add");
                        if (response.status==200){
                            if (response.data == 1) {
                                $('#addCourseModal').modal('hide');
                                toastr.success('Add Successful!');
                                getCoursesData();
                            } else {
                                $('#addCourseModal').modal('hide');
                                toastr.error('Add Fail!');
                                getCoursesData();
                            }
                        } else {
                            $('#addCourseModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#addCourseModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    });
            }
        }

        //Courses Add Modal Save Btn
        $('#CourseAddConfirmBtn').click(function() {
            var CourseName = $('#CourseNameId').val();
            var CourseDes = $('#CourseDesId').val();
            var CourseFee = $('#CourseFeeId').val();
            var CourseEnroll = $('#CourseEnrollId').val();
            var CourseClass = $('#CourseClassId').val();
            var CourseLink = $('#CourseLinkId').val();
            var CourseImg = $('#CourseImgId').val();
            CourseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg)
        })

        //Course Delete
        function CourseDelete(deleteID) {

            $('#CourseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
            axios.post('/CourseDelete', {
                id: deleteID
            })
                .then(function(response) {
                    $('#CourseDeleteConfirmBtn').html("Yes");
                    if (response.status==200){
                        if (response.data == 1) {
                            $('#deleteCourseModal').modal('hide');
                            toastr.success('Delete Successful!');
                            getCoursesData();
                        } else {
                            $('#deleteCourseModal').modal('hide');
                            toastr.error('Delete Fail!');
                            getCoursesData();
                        }
                    } else {
                        $('#deleteCourseModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }

                })
                .catch(function(error) {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                });
        }

        //Course Delete Modal Yes Btn
        $('#CourseDeleteConfirmBtn').click(function() {
            var id = $('#CourseDeleteId').html();
            CourseDelete(id);
        })

        //Each Course Update Details
        function CourseUpdateDetails(detailsID) {
            axios.post('/CoursesDetails', {
                id: detailsID
            })
                .then(function(response) {
                    if (response.status==200){
                        $('#CourseEditForm').removeClass('d-none');
                        $('#CourseEditLoader').addClass('d-none');
                        var dataJSON = response.data;
                        $('#CourseNameEditId').val(dataJSON[0].course_name);
                        $('#CourseDesEditId').val(dataJSON[0].course_des);
                        $('#CourseFeeEditId').val(dataJSON[0].course_fee);
                        $('#CourseEnrollEditId').val(dataJSON[0].course_totalenroll);
                        $('#CourseClassEditId').val(dataJSON[0].course_totalclass);
                        $('#CourseLinkEditId').val(dataJSON[0].course_link);
                        $('#CourseImgEditId').val(dataJSON[0].course_img);
                    }
                    else {
                        $('#CourseEditLoader').addClass('d-none');
                        $('#CourseEditWrong').removeClass('d-none');
                        $('#CourseEditWrongIcon').removeClass('d-none');
                    }
                })
                .catch(function(error) {
                    $('#CourseEditLoader').addClass('d-none');
                    $('#CourseEditWrong').removeClass('d-none');
                    $('#CourseEditWrongIcon').removeClass('d-none');
                });
        }

        //Course Update Method
        function CourseUpdate(CourseID,CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg) {

            if(CourseName.length==0){
                toastr.error('Course Name is Empty !');
            }
            else if(CourseDes.length==0){
                toastr.error('Course Description is Empty !');
            }
            else if(CourseFee.length==0){
                toastr.error('Course Fee is Empty !');
            }
            else if(CourseEnroll.length==0){
                toastr.error('Course Enroll is Empty !');
            }
            else if(CourseClass.length==0){
                toastr.error('Course Class is Empty !');
            }
            else if(CourseLink.length==0){
                toastr.error('Course Link is Empty !');
            }
            else if(CourseImg.length==0){
                toastr.error('Course Image is Empty !');
            }
            else {
                $('#CourseEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
                axios.post('/CourseUpdate', {
                    id: CourseID,
                    course_name: CourseName,
                    course_des: CourseDes,
                    course_fee: CourseFee,
                    course_totalenroll: CourseEnroll,
                    course_totalclass: CourseClass,
                    course_link: CourseLink,
                    course_img: CourseImg,
                })
                    .then(function(response) {
                        $('#CourseEditConfirmBtn').html("Save");
                        if (response.status==200){
                            if (response.data == 1) {
                                $('#editCourseModal').modal('hide');
                                toastr.success('Update Successful!');
                                getCoursesData();
                            } else {
                                $('#editCourseModal').modal('hide');
                                toastr.error('Update Fail!');
                                getCoursesData();
                            }
                        } else {
                            $('#editCourseModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#editCourseModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    });
            }
        }

        //Course Edit Modal Save Btn
        $('#CourseEditConfirmBtn').click(function() {
            var CourseID = $('#CourseEditId').html();
            var CourseName = $('#CourseNameEditId').val();
            var CourseDes = $('#CourseDesEditId').val();
            var CourseFee = $('#CourseFeeEditId').val();
            var CourseEnroll = $('#CourseEnrollEditId').val();
            var CourseClass = $('#CourseClassEditId').val();
            var CourseLink = $('#CourseLinkEditId').val();
            var CourseImg = $('#CourseImgEditId').val();
            CourseUpdate(CourseID,CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);
        })

    </script>

@endsection