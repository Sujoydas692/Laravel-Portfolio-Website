//Visitor Page Table
$(document).ready(function() {
    $('#visitor_table').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

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

                //Services Delete Modal Yes Btn
                $('#serviceDeleteConfirmBtn').click(function() {
                    var id = $('#serviceDeleteId').html();
                    ServiceDelete(id);
                })

                //Services Table Edit Icon Click
                $('.serviceEditBtn').click(function() {
                    var id = $(this).data('id');

                    ServiceUpdateDetails(id);

                    $('#serviceEditId').html(id);
                    $('#editModal').modal('show');
                })

                //Services Edit Modal Save Btn
                $('#serviceEditConfirmBtn').click(function() {
                    var id = $('#serviceEditId').html();
                    var name = $('#ServiceNameID').val();
                    var des = $('#ServiceDesID').val();
                    var img = $('#ServiceImgID').val();
                    ServiceUpdate(id,name,des,img)
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

//Get Visitor Data
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
            } else {
                $('#loaderDiv').addClass('d-none');
                $('#WrongDiv').removeClass('d-none');
            }

        }).catch(function(error) {
        $('#loaderDiv').addClass('d-none');
        $('#WrongDiv').removeClass('d-none');
    });
}

//Service Delete
function ServiceDelete(deleteID) {
    axios.post('/ServiceDelete', {
        id: deleteID
    })
        .then(function(response) {
            if (response.data == 1) {
                $('#deleteModal').modal('hide');
                toastr.success('Delete Successful!');
                getServicesData();
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Delete Fail!');
                getServicesData();
            }
        })
        .catch(function(error) {

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

function ServiceUpdate(serviceID,serviceName,serviceDes,serviceImg) {
    axios.post('/ServiceUpdate', {
        id: serviceID,
        service_name: serviceName,
        service_des: serviceDes,
        service_img: serviceImg,
    })
        .then(function(response) {
            if (response.status==200){

            }
            else {

            }
        })
        .catch(function(error) {

        });
}