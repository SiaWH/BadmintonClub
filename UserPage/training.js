// Booking 
function Booking(){
    var book = document.querySelector('.hiddenBooking');

    if (book.style.display === 'block'){
        book.style.display = 'none';
    }
    else {
        book.style.display = 'block';
    }
}

//Booking Success Alert
document.getElementById("book-btn").addEventListener("click", function(event) {
    alert("Booking Successful!");
  });

