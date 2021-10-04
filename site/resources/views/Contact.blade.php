@extends('Layout.app')
@section('title', 'Contact')
@section('content')

    <div class="container-fluid jumbotron mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6  text-center">
                <h1 class="page-top-title mt-3">- যোগাযোগ করুন -</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.756995352632!2d90.3871690144559!3d23.756043494478764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8a3ef138595%3A0x5fc950e38d0099c8!2sJoykoly%20Publications!5e0!3m2!1sen!2sbd!4v1633332123571!5m2!1sen!2sbd" width="550" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-md-6">
                <h3 class="service-card-title text-center">ঠিকানা</h3>
                <hr>
                <p class="footer-text text-center"><i class="fas fa-map-marker-alt"></i> শেখেরটেক ৮ মোহাম্মদপুর, ঢাকা  <i class="fas ml-3 fa-phone"></i> ০১৭৮৫৩৮৮৯১৯  <i class="fas ml-3 fa-envelope"></i> Rabbil@Yahoo.com</p>
                <hr>
                <h5 class="service-card-title text-center">যোগাযোগ করুন </h5>
                <div class="form-group ">
                    <input id="contactNameID" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contactPhnID" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contactEmailID" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contactMsgID" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button id="contactSendBtnID" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
            </div>
            </div>
        </div>
    </div>

@endsection