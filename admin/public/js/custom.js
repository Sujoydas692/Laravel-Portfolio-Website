//For Courses Table
function getCoursesData() {
    axios.get('/getCoursesData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');

                $('#course_table').empty();

                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td>" + dataJSON[i].course_name + "</td>" +
                        "<td>" + dataJSON[i].course_fee + "</td>" +
                        "<td>" + dataJSON[i].course_totalclass + "</td>" +
                        "<td>" + dataJSON[i].course_totalenroll + "</td>" +
                        "<td><a class='courseViewDetailsBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-eye'></i></a></td>" +
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
                $('#CourseEditForm1').removeClass('d-none');
                $('#CourseEditForm2').removeClass('d-none');
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
    var id = $('#CourseEditId').html();
    var name = $('#CourseNameId').val();
    var des = $('#CourseDesId').val();
    var fee = $('#CourseFeeId').val();
    var enroll = $('#CourseEnrollId').val();
    var cls = $('#CourseClassId').val();
    var link = $('#CourseLinkId').val();
    var img = $('#CourseImgId').val();
    CourseUpdate(id,name,des,fee,enroll,cls,link,img)
})
