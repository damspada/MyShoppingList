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





