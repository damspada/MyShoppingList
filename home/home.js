// -------------------------------- Animazione Background --------------------------------
let headerBackgrounds = document.querySelectorAll(".background");

let imageIndex = 0;

function changeBackground(){
    headerBackgrounds[imageIndex].classList.remove("showing");

    imageIndex++;

    if(imageIndex >= headerBackgrounds.length){
        imageIndex = 0;
    }

    headerBackgrounds[imageIndex].classList.add("showing");
}

setInterval(changeBackground, 6000);



// -------------------------------- Back To Top --------------------------------
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    var backToTopBtn = document.getElementById("back-to-top-btn");
    if (document.body.scrollTop > 2000 || document.documentElement.scrollTop > 2000) {
        backToTopBtn.classList.add("show"); 
    } else {
        backToTopBtn.classList.remove("show");
    }

    if(window.innerWidth <= 720){
        backToTopBtn.classList.remove("show");
    }
}

document.getElementById("back-to-top-btn").addEventListener("click", function(event) {
    event.preventDefault();
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});







