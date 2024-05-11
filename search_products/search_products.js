// Funzione per mostrare il carrello quando la larghezza della finestra è superiore a 1100px
function mostraCarrello() {
    if (window.innerWidth > 1100) {
        var carrelloDiv = document.getElementById("carrello_div");
        carrelloDiv.style.display = "block";
        document.body.classList.remove('popup-active');
    } else {
        var carrelloDiv = document.getElementById("carrello_div");
        carrelloDiv.style.display = "none";
    }
}

// Funzione per aprire il popup del carrello quando viene cliccata l'icona del carrello
function mostraPopupCarrello(event) {
    if (window.innerWidth <= 1100){
        event.stopPropagation(); // Evita la chiusura del popup quando si fa clic sull'icona del carrello
        var popupCarrello = document.getElementById("carrello_div");
        // var overlay2 = document.querySelector('.overlay2');
        popupCarrello.style.display = "block";
    
        // overlay2.style.display = "block";
        document.body.classList.add('popup-active'); // Aggiunge la classe al body per gestire lo scrolling e l'overlay
    }
}

// Funzione per chiudere il popup del carrello quando viene cliccato fuori dal popup
function chiudiPopupCarrello(event) {
    // Verifica se la larghezza della finestra è inferiore o uguale a 1100px
    if (window.innerWidth <= 1100) {
        var popupCarrello = document.getElementById("carrello_div");
        
        var overlay2 = document.querySelector('.overlay2');
        popupCarrello.style.display = "none";
        
        overlay2.style.display = "none";
        document.body.classList.remove('popup-active'); // Rimuove la classe dal body per gestire lo scrolling e l'overlay
    }
}

// Funzione per chiudere il carrello
function chiudiCarrello() {
    if (window.innerWidth <= 1100) {
        var popupCarrello = document.getElementById("carrello_div");
        var overlay2 = document.querySelector('.overlay2');
        popupCarrello.style.display = "none";
        overlay2.style.display = "none";
        document.body.classList.remove('popup-active');

        // // Rimuovi l'overlay2 solo se il checkout non è attivo
        // if (!document.querySelector('.wrapper_checkout').classList.contains('active-popup')) {
        //     var overlay2 = document.querySelector('.overlay2');
        //     overlay2.style.display = "none";
        // }
    }
}

function chiudi_checkout(){
    if (window.innerWidth <= 1100){
        var overlay3 = document.querySelector('.overlay3');
        overlay3.style.display = "none";
    }
}

document.querySelector('.icon_close_checkout').addEventListener('click', chiudi_checkout);

// Aggiungi un gestore di eventi al pulsante Checkout per chiudere il carrello
var checkoutButton = document.querySelector('.bottone_checkout');
checkoutButton.addEventListener('click', chiudiPopupCarrello);

// Aggiungi un gestore di eventi per aprire il popup del carrello quando viene cliccata l'icona del carrello
document.getElementById("cart_icon").addEventListener("click", mostraPopupCarrello);


// Aggiungi un gestore di eventi per controllare la larghezza della finestra e mostrare il carrello di conseguenza
window.addEventListener('resize', mostraCarrello);

// Mostra il carrello all'avvio della pagina
window.addEventListener('DOMContentLoaded', mostraCarrello);
