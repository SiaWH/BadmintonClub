//Image Slider
var slideIndex = 1;

showSlides(slideIndex);

function nextSlide(n) {
    slideIndex++;
    showSlides(slideIndex);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("sliders");
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slides[slideIndex-1].style.display = "block";   
}

setInterval(nextSlide, 6000);

//Show More
function showMore(){
    document.getElementById("press").style.display = "flex";
    document.getElementById("more").style.display = "none";
}