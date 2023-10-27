var participate = document.getElementById("bookingbtn");
var payment = document.querySelector('.payment');
var closePayment = document.getElementById("clsBookingBtn");
var bookclose = document.querySelector('.msg');

$(document).ready(function(){
   $(participate).click(function(){
      $(payment).fadeIn(400); 
   });
});

$(document).ready(function(){
   $(closePayment).click(function(){
      $(payment).fadeOut(400); 
   });
});

$(document).ready(function(){
   $('.words button').click(function(){
      $(bookclose).fadeOut(100); 
   });
});

//function paymentForm(){
//    if (payment.style.display === 'none'){
//        payment.style.display = 'block';
//    }
//    else {
//        payment.style.display = 'none';
//    }
//}


//function closeBooking(){
//    var bookclose = document.querySelector('.msg');
//
//    bookclose.style.display = 'none';
//}