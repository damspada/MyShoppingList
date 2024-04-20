// -------------------------------- Navbar Responsive --------------------------------
function showSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display = 'flex'
}

function hideSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display = 'none'
  }


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
        backToTopBtn.classList.add("show"); /* Aggiungi la classe "show" per visualizzare il bottone */
    } else {
        backToTopBtn.classList.remove("show"); /* Rimuovi la classe "show" per nascondere il bottone */
    }
}

document.getElementById("back-to-top-btn").addEventListener("click", function(event) {
    event.preventDefault();
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});







