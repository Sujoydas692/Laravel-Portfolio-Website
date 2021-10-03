@extends('Layout.app')
@section('content')

    {{--Project Main Div--}}
    <div id="mainDivProjects" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button id="addNewProjectBtnID" class="btn my-3 btn-sm btn-danger"><i class="fas fa-plus"></i>  Add New</button>
                <table id="ProjectDt" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Project Name</th>
                        <th class="th-sm">Project Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="project_table">





                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{--Project Loader Div--}}
    <div id="loaderDivProject" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="w-50 m-5" src="{{asset('images/loader.gif')}}">

            </div>
        </div>
    </div>

    {{--Project Wrong Div--}}
    <div id="WrongDivProject" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h1><i class="far fa-frown"></i></h1>
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>

    {{--Add Project Modal--}}
    <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row">
                            <div id="ProjectAddForm" class="w-100">
                                <h6 class="mb-4">Add New Project</h6>
                                <input type="text" id="ProjectNameAddID" class="form-control mb-4" placeholder="Project Name">
                                <input type="text" id="ProjectDesAddID" class="form-control mb-4" placeholder="Project Description">
                                <input type="text" id="ProjectLinkAddID" class="form-control mb-4" placeholder="Project Link">
                                <input type="text" id="ProjectImgAddID" class="form-control mb-4" placeholder="Project Image Link">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="ProjectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add</button>
                </div>
            </div>
        </div>
    </div>

    {{--Delete Project Modal--}}
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <h5 id="ProjectDeleteId" class="mt-4 d-none"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button id="ProjectDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

    {{--Edit Project Modal--}}
    <div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <h5 id="ProjectEditId" class="mt-4 d-none"></h5>
                    <div id="ProjectEditForm" class="container d-none">
                        <div class="row">
                            <div id="ProjectEditForm" class="w-100">
                                <h6 class="mb-4">Update Project</h6>
                                <input type="text" id="ProjectNameEditID" class="form-control mb-4" placeholder="Project Name">
                                <input type="text" id="ProjectDesEditID" class="form-control mb-4" placeholder="Project Description">
                                <input type="text" id="ProjectLinkEditID" class="form-control mb-4" placeholder="Project Link">
                                <input type="text" id="ProjectImgEditID" class="form-control mb-4" placeholder="Project Image Link">
                            </div>
                        </div>
                    </div>
                    <img id="ProjectEditLoader" class="w-75 m-5" src="{{asset('images/loader.gif')}}">
                    <h1 id="ProjectEditWrongIcon" class="d-none"><i class="far fa-frown"></i></h1>
                    <h5 id="ProjectEditWrong" class="d-none">Something Went Wrong!</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="ProjectEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script type="text/javascript">
        getProjectsData();

        //For Projects Table
        function getProjectsData() {
            axios.get('/getProjectsData')
                .then(function(response) {

                    if (response.status == 200) {

                        $('#mainDivProjects').removeClass('d-none');
                        $('#loaderDivProject').addClass('d-none');

                        $('#ProjectDt').DataTable().destroy();
                        $('#project_table').empty();

                        var dataJSON = response.data;
                        $.each(dataJSON, function(i, item) {
                            $('<tr>').html(
                                "<td>" + dataJSON[i].project_name + "</td>" +
                                "<td>" + dataJSON[i].project_des + "</td>" +
                                "<td><a class='projectEditBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                                "<td><a class='projectDeleteBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-trash-alt'></i></a></td>"
                            ).appendTo('#project_table');
                        });

                        //For Project Table Delete Icon Click
                        $('.projectDeleteBtn').click(function() {

                            var id = $(this).data('id');
                            $('#ProjectDeleteId').html(id);

                            $('#deleteProjectModal').modal('show');
                        })

                        //Project Table Edit Icon Click
                        $('.projectEditBtn').click(function() {

                            var id = $(this).data('id');
                            ProjectUpdateDetails(id);

                            $('#ProjectEditId').html(id);
                            $('#editProjectModal').modal('show');
                        })

                        //Project Page Table
                        $(document).ready(function() {
                            $('#ProjectDt').DataTable({"order":false});
                            $('.dataTables_length').addClass('bs-select');
                        });

                    } else {
                        $('#loaderDivProject').addClass('d-none');
                        $('#WrongDivProject').removeClass('d-none');
                    }

                }).catch(function(error) {
                $('#loaderDivProject').addClass('d-none');
                $('#WrongDivProject').removeClass('d-none');
            });
        }

        //Project Add Button Click
        $('#addNewProjectBtnID').click(function () {
            $('#addProjectModal').modal('show');
        });

        //Project Add Method
        function ProjectAdd(ProjectName,ProjectDes,ProjectLink,ProjectImg) {

            if(ProjectName.length==0){
                toastr.error('Project Name is Empty !');
            }
            else if(ProjectDes.length==0){
                toastr.error('Project Description is Empty !');
            }
            else if(ProjectLink.length==0){
                toastr.error('Project Link is Empty !');
            }
            else if(ProjectImg.length==0){
                toastr.error('Project Image is Empty !');
            }
            else {
                $('#ProjectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
                axios.post('/ProjectAdd', {
                    project_name: ProjectName,
                    project_des: ProjectDes,
                    project_link: ProjectLink,
                    project_img: ProjectImg,
                })
                    .then(function(response) {
                        $('#ProjectAddConfirmBtn').html("Add");
                        if (response.status==200){
                            if (response.data == 1) {
                                $('#addProjectModal').modal('hide');
                                toastr.success('Add Successful!');
                                getProjectsData();
                            } else {
                                $('#addProjectModal').modal('hide');
                                toastr.error('Add Fail!');
                                getProjectsData();
                            }
                        } else {
                            $('#addProjectModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#addProjectModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    });
            }
        }

        //Project Add Modal Save Btn
        $('#ProjectAddConfirmBtn').click(function() {
            var ProjectName = $('#ProjectNameAddID').val();
            var ProjectDes = $('#ProjectDesAddID').val();
            var ProjectLink = $('#ProjectLinkAddID').val();
            var ProjectImg = $('#ProjectImgAddID').val();
            ProjectAdd(ProjectName,ProjectDes,ProjectLink,ProjectImg)
        })

        //Project Delete
        function ProjectDelete(deleteID) {

            $('#ProjectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
            axios.post('/ProjectDelete', {
                id: deleteID
            })
                .then(function(response) {
                    $('#ProjectDeleteConfirmBtn').html("Yes");
                    if (response.status==200){
                        if (response.data == 1) {
                            $('#deleteProjectModal').modal('hide');
                            toastr.success('Delete Successful!');
                            getProjectsData();
                        } else {
                            $('#deleteProjectModal').modal('hide');
                            toastr.error('Delete Fail!');
                            getProjectsData();
                        }
                    } else {
                        $('#deleteProjectModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }

                })
                .catch(function(error) {
                    $('#deleteProjectModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                });
        }

        //Project Delete Modal Yes Btn
        $('#ProjectDeleteConfirmBtn').click(function() {
            var id = $('#ProjectDeleteId').html();
            ProjectDelete(id);
        })

        //Each Project Update Details
        function ProjectUpdateDetails(detailsID) {
            axios.post('/ProjectsDetails', {
                id: detailsID
            })
                .then(function(response) {
                    if (response.status==200){
                        $('#ProjectEditForm').removeClass('d-none');
                        $('#ProjectEditLoader').addClass('d-none');
                        var dataJSON = response.data;
                        $('#ProjectNameEditID').val(dataJSON[0].project_name);
                        $('#ProjectDesEditID').val(dataJSON[0].project_des);
                        $('#ProjectLinkEditID').val(dataJSON[0].project_link);
                        $('#ProjectImgEditID').val(dataJSON[0].project_img);
                    }
                    else {
                        $('#ProjectEditLoader').addClass('d-none');
                        $('#ProjectEditWrong').removeClass('d-none');
                        $('#ProjectEditWrongIcon').removeClass('d-none');
                    }
                })
                .catch(function(error) {
                    $('#ProjectEditLoader').addClass('d-none');
                    $('#ProjectEditWrong').removeClass('d-none');
                    $('#ProjectEditWrongIcon').removeClass('d-none');
                });
        }

        //Project Update Method
        function ProjectUpdate(ProjectID,ProjectName,ProjectDes,ProjectLink,ProjectImg) {

            if(ProjectName.length==0){
                toastr.error('Project Name is Empty !');
            }
            else if(ProjectDes.length==0){
                toastr.error('Project Description is Empty !');
            }
            else if(ProjectLink.length==0){
                toastr.error('Project Link is Empty !');
            }
            else if(ProjectImg.length==0){
                toastr.error('Project Image is Empty !');
            }
            else {
                $('#ProjectEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
                axios.post('/ProjectUpdate', {
                    id: ProjectID,
                    project_name: ProjectName,
                    project_des: ProjectDes,
                    project_link: ProjectLink,
                    project_img: ProjectImg,
                })
                    .then(function(response) {
                        $('#ProjectEditConfirmBtn').html("Save");
                        if (response.status==200){
                            if (response.data == 1) {
                                $('#editProjectModal').modal('hide');
                                toastr.success('Update Successful!');
                                getProjectsData();
                            } else {
                                $('#editProjectModal').modal('hide');
                                toastr.error('Update Fail!');
                                getProjectsData();
                            }
                        } else {
                            $('#editProjectModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#editProjectModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    });
            }
        }

        //Project Edit Modal Save Btn
        $('#ProjectEditConfirmBtn').click(function() {
            var ProjectID = $('#ProjectEditId').html();
            var ProjectName = $('#ProjectNameEditID').val();
            var ProjectDes = $('#ProjectDesEditID').val();
            var ProjectLink = $('#ProjectLinkEditID').val();
            var ProjectImg = $('#ProjectImgEditID').val();
            ProjectUpdate(ProjectID,ProjectName,ProjectDes,ProjectLink,ProjectImg);
        })
    </script>

    @endsection