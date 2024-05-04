const wrapper=document.querySelector('.wrapper');
const body = document.querySelector('body');
const loginLink=document.querySelector('.login-link');
// const registerLink=document.querySelector('.register-link');
const iconClose= document.querySelector('.icon-close');
const btnPopup=document.querySelector('.Btn');

// registerLink.addEventListener('click', ()=>{
//     wrapper.classList.add('active');
//     body.classList.add('popup-active');
// });

loginLink.addEventListener('click', ()=>{
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', ()=>{
    wrapper.classList.add('active-popup');
    body.classList.add('popup-active');
});

iconClose.addEventListener('click', ()=>{
    wrapper.classList.remove('active-popup');
    body.classList.remove('popup-active');
    hidePopup();
});


swal({
    title: "Errore!",
    text: "Invalid credentials. Try again.",
    icon: "error",
    button: "OK",
    dangerMode: true,
    background: "#f8f9fa",
    confirmButtonColor: "#dc3545",
    textColor: "#343a40",
    width: "400px",
    padding: "3rem",
    titleFont: "Montserrat_Arabic_Regular",
    textFont: "Montserrat_Arabic_Regular"
});






