$(document).ready(function () {
    $('#nav-icon1').click(function () {
        $(this).toggleClass('open');
    });
});


var slideIndex = 1;

function closeModal() {
    $("#pending-modal").modal('hide')
}

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function showSlides(n) {
    console.log("index" + slideIndex)
    console.log(n)

    const slides = document.getElementsByClassName("mySlides");
    console.log("duzina" + slides.length)
    if (slides.length == 0) {
        $('#pending-modal').modal('hide');
        return;
    }

    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    //Pocinje niz od 0 zato -1
    slides[slideIndex - 1].style.display = "block";
}