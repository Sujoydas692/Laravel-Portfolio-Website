@extends('Layout.app')
@section('title',"Contact")
@section('content')

    {{--Contact Main Div--}}
    <div id="mainDivContact" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <table id="ContactDt" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Contact Name</th>
                        <th class="th-sm">Contact Phone</th>
                        <th class="th-sm">Contact Email</th>
                        <th class="th-sm">Contact Message</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="contact_table">





                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{--Contact Loader Div--}}
    <div id="loaderDivContact" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="w-50 m-5" src="{{asset('images/loader.gif')}}">

            </div>
        </div>
    </div>

    {{--Contact Wrong Div--}}
    <div id="WrongDivContact" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h1><i class="far fa-frown"></i></h1>
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>

    {{--Delete Contact Modal--}}
    <div class="modal fade" id="deleteContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <h5 id="ContactDeleteId" class="mt-4 d-none"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button id="ContactDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        getContactsData();

        //For Contact Table
        function getContactsData() {
            axios.get('/getContactsData')
                .then(function(response) {

                    if (response.status == 200) {

                        $('#mainDivContact').removeClass('d-none');
                        $('#loaderDivContact').addClass('d-none');

                        $('#ContactDt').DataTable().destroy();
                        $('#contact_table').empty();

                        var dataJSON = response.data;
                        $.each(dataJSON, function(i, item) {
                            $('<tr>').html(
                                "<td>" + dataJSON[i].contact_name + "</td>" +
                                "<td>" + dataJSON[i].contact_phn + "</td>" +
                                "<td>" + dataJSON[i].contact_email + "</td>" +
                                "<td>" + dataJSON[i].contact_msg + "</td>" +
                                "<td><a class='contactDeleteBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-trash-alt'></i></a></td>"
                            ).appendTo('#contact_table');
                        });

                        //For Contact Table Delete Icon Click
                        $('.contactDeleteBtn').click(function() {

                            var id = $(this).data('id');
                            $('#ContactDeleteId').html(id);

                            $('#deleteContactModal').modal('show');
                        })

                        //Contact Page Table
                        $(document).ready(function() {
                            $('#ContactDt').DataTable({"order":false});
                            $('.dataTables_length').addClass('bs-select');
                        });

                    } else {
                        $('#loaderDivContact').addClass('d-none');
                        $('#WrongDivContact').removeClass('d-none');
                    }

                }).catch(function(error) {
                $('#loaderDivContact').addClass('d-none');
                $('#WrongDivContact').removeClass('d-none');
            });
        }

        //Contact Delete
        function ContactDelete(deleteID) {

            $('#ContactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
            axios.post('/contactDelete', {
                id: deleteID
            })
                .then(function(response) {
                    $('#ContactDeleteConfirmBtn').html("Yes");
                    if (response.status==200){
                        if (response.data == 1) {
                            $('#deleteContactModal').modal('hide');
                            toastr.success('Delete Successful!');
                            getContactsData();
                        } else {
                            $('#deleteContactModal').modal('hide');
                            toastr.error('Delete Fail!');
                            getContactsData();
                        }
                    } else {
                        $('#deleteContactModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }

                })
                .catch(function(error) {
                    $('#deleteContactModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                });
        }

        //Contact Delete Modal Yes Btn
        $('#ContactDeleteConfirmBtn').click(function() {
            var id = $('#ContactDeleteId').html();
            ContactDelete(id);
        })

    </script>

@endsection