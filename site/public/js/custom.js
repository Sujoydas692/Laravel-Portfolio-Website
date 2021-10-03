// Owl Carousel Start..................
$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});
// Owl Carousel End..................


$('#contactSendBtnID').click(function () {
    var contactName = $('#contactNameID').val();
    var contactPhone = $('#contactPhnID').val();
    var contactEmail = $('#contactEmailID').val();
    var contactMessage = $('#contactMsgID').val();

    sendContact(contactName,contactPhone,contactEmail,contactMessage)
})

//Contact Send
function sendContact(contactName,contactPhone,contactEmail,contactMessage) {
    if (contactName.length==0){
        $('#contactSendBtnID').html('আপনার নাম লিখুন!');
        setTimeout(function () {
            $('#contactSendBtnID').html('পাঠিয়ে দিন');
        },2000)
    }
    else if (contactPhone.length==0){
        $('#contactSendBtnID').html('আপনার মোবাইল নং লিখুন!');
        setTimeout(function () {
            $('#contactSendBtnID').html('পাঠিয়ে দিন');
        },2000)
    }
    else if (contactEmail.length==0){
        $('#contactSendBtnID').html('আপনার ইমেইল লিখুন!');
        setTimeout(function () {
            $('#contactSendBtnID').html('পাঠিয়ে দিন');
        },2000)
    }
    else if (contactMessage.length==0){
        $('#contactSendBtnID').html('আপনার মেসেজ লিখুন!');
        setTimeout(function () {
            $('#contactSendBtnID').html('পাঠিয়ে দিন');
        },2000)
    }
    else {
        $('#contactSendBtnID').html('পাঠানো হচ্ছে...');

        axios.post('/contactSend',{
            contact_name: contactName,
            contact_phn: contactPhone,
            contact_email: contactEmail,
            contact_msg: contactMessage,
        })
            .then(function (response) {
                if (response.status==200){
                    if (response.data==1){
                        $('#contactSendBtnID').html('অনুরোধ সফল হয়েছে!');
                        setTimeout(function () {
                            $('#contactSendBtnID').html('পাঠিয়ে দিন');
                        },3000)
                    }
                    else {
                        $('#contactSendBtnID').html('অনুরোধ ব্যার্থ হয়েছে! আবার চেষ্টা করুন');
                        setTimeout(function () {
                            $('#contactSendBtnID').html('পাঠিয়ে দিন');
                        },3000)
                    }
                }
                else {
                    $('#contactSendBtnID').html('অনুরোধ ব্যার্থ হয়েছে! আবার চেষ্টা করুন');
                    setTimeout(function () {
                        $('#contactSendBtnID').html('পাঠিয়ে দিন');
                    },3000)
                }
            })
            .catch(function (error) {
            $('#contactSendBtnID').html('আবার চেষ্টা করুন!');
            setTimeout(function () {
                $('#contactSendBtnID').html('পাঠিয়ে দিন');
            },3000)
        });
    }
}