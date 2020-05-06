var slideIndex = 1;
showSlides(slideIndex, ClassSlide);

// Next/previous controls
function plusSlides(n, ClassSlide) {
    showSlides(slideIndex += n, ClassSlide);
}

// Thumbnail image controls
function currentSlide(n, ClassSlide) {
    showSlides(slideIndex = n, ClassSlide);
}


function showSlides(n, ClassSlide) {
    var i;
    var slides = document.getElementsByClassName(ClassSlide);
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}