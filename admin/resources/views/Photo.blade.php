@extends('Layout.app')
@section('title',"Photo Gallery")
@section('content')

    {{--Photo Main Div--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <button data-toggle="modal" data-target="#PhotoModal" id="addNewPhotoBtnID" class="btn my-3 btn-sm btn-danger"><i class="fas fa-plus"></i>  Add New</button>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row PhotoRow">

        </div>
        <button id="LoadMoreBtn" class="btn btn-sm btn-primary">Load More</button>
    </div>

    {{--Modal--}}
    <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" id="imageInput" type="file">
                    <img class="imagePreview mt-3" id="imagePreview" src="{{asset('images/default.png')}}" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                    <button id="SavePhoto" type="button" class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>

    @endsection

@section('script')

    <script type="text/javascript">
        $('#imageInput').change(function () {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload=function (event) {
               var ImgSource = event.target.result;
                $('#imagePreview').attr('src',ImgSource);
            }
        })

        $('#SavePhoto').on('click',function () {

            $('#SavePhoto').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

            var PhotoFile = $('#imageInput').prop('files')[0];
            var formData = new FormData();
            formData.append('photo',PhotoFile);

            axios.post("/PhotoUpload",formData).then(function (response) {

                if (response.status==200 && response.data==1){
                    $('#PhotoModal').modal('hide');
                    $('#SavePhoto').html('Save');
                    toastr.success('Photo Upload Successful!');

                } else {
                    toastr.error('Photo Upload Fail!');
                    window.location.href="/photo";
                }
            }).catch(function (error) {
                toastr.error('Photo Upload Fail!');
                window.location.href="/photo";
            })
        })

        LoadPhoto();
        function LoadPhoto() {
            let URL = "/PhotoJSON";
            axios.get(URL).then(function (response) {
                $.each(response.data, function(i, item) {
                    $("<div class='col-md-3 p-1'>").html(
                        "<img data-id="+item['id']+" class='imageOnRow' src="+item['location']+">"+
                        "<button data-id="+item['id']+" data-photo="+item['location']+" class='btn deletePhoto btn-sm'>Delete</button>"
                    ).appendTo('.PhotoRow');
                    
                    $('.deletePhoto').on('click',function (event) {
                        let id = $(this).data('id');
                        let photo = $(this).data('photo');
                        PhotoDelete(photo,id);
                        event.preventDefault();
                    })
                });
            }).catch(function (error) {
                
            })
        }

        var ImgID = 0;
        function LoadByTD(FirstImgID,loadMoreBtn){
            ImgID = ImgID+4;
            let PhotoID = ImgID+FirstImgID;
            let URL = "/PhotoJSONByID/"+PhotoID;
            loadMoreBtn.html("<div class='spinner-border spinner-border-sm' role='status'></div>");
            axios.get(URL).then(function (response) {
                loadMoreBtn.html("Load More");
                $.each(response.data, function(i, item) {
                    $("<div class='col-md-3 p-1'>").html(
                        "<img data-id="+item['id']+" class='imageOnRow' src="+item['location']+">"+
                            "<button data-id="+item['id']+" data-photo="+item['location']+" class='btn btn-sm'>Delete</button>"
                    ).appendTo('.PhotoRow');
                });
            }).catch(function (error) {

            })
        }

        $('#LoadMoreBtn').on('click',function () {
            let loadMoreBtn = $(this);
            let FirstImgID = $(this).closest('div').find('img').data('id');
            LoadByTD(FirstImgID,loadMoreBtn);
        })

        function PhotoDelete(OldPhotoURL,id) {
            let URL = "/PhotoDelete";
            let myFormData = new FormData();

            myFormData.append('OldPhotoURL',OldPhotoURL);
            myFormData.append('id',id);

            axios.post(URL,myFormData).then(function (response) {
                if (response.status==200 && response.data==1){
                    toastr.success('photo Delete Successful!');
                    $('.PhotoRow').empty();
                    window.location.href="/photo";
                }
                else {
                    toastr.error('photo Delete Fail!');
                }
            }).catch(function (error) {
                toastr.error('photo Delete Fail!');
            })
        }
    </script>

    @endsection