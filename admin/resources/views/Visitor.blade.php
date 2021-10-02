@extends('Layout.app')

@section('content')

    <div id="mainDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <table id="VisitorDt" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">NO</th>
                        <th class="th-sm">IP</th>
                        <th class="th-sm">Date & Time</th>
                    </tr>
                    </thead>
                    <tbody id="visitor_table">




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

@endsection

@section('script')

    <script type="text/javascript">
        getVisitorData();

        //For Visitor Table
        function getVisitorData() {
            axios.get('/getVisitorData')
                .then(function(response) {

                    if (response.status == 200) {

                        $('#mainDiv').removeClass('d-none');
                        $('#loaderDiv').addClass('d-none');

                        var dataJSON = response.data;
                        $.each(dataJSON, function(i, item) {
                            $('<tr>').html(
                                "<td>" + dataJSON[i].id + "</td>" +
                                "<td>" + dataJSON[i].ip_address + "</td>" +
                                "<td>" + dataJSON[i].visiting_time + "</td>"
                            ).appendTo('#visitor_table');
                        });

                        //Visitor Page Table
                        $(document).ready(function() {
                            $('#VisitorDt').DataTable({"order":false});
                            $('.dataTables_length').addClass('bs-select');
                        });
                    } else {
                        $('#loaderDiv').addClass('d-none');
                        $('#WrongDiv').removeClass('d-none');
                    }

                }).catch(function(error) {
                $('#loaderDiv').addClass('d-none');
                $('#WrongDiv').removeClass('d-none');
            });
        }
    </script>


@endsection