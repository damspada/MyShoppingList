const wrapper=document.querySelector('.wrapper');
const body = document.querySelector('body');
const loginLink=document.querySelector('.login-link');
const iconClose= document.querySelector('.icon-close');
const btnPopup=document.querySelector('.Btn');


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
});






