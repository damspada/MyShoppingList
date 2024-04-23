const wrapper=document.querySelector('.wrapper');
const body = document.querySelector('body');
const loginLink=document.querySelector('.login-link');
const registerLink=document.querySelector('.register-link');
const iconClose= document.querySelector('.icon-close');
const btnPopup=document.querySelector('.Btn');

registerLink.addEventListener('click', ()=>{
    wrapper.classList.add('active');
    body.classList.add('popup-active');
});

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


function openPopup(type) {
    if (type === 'register') {
        wrapper.classList.add('active');
        body.classList.add('popup-active');
        currentPopup = 'register';
    } else if (type === 'login') {
        wrapper.classList.remove('active');
        body.classList.remove('popup-active');
        currentPopup = 'login';
    }
}




