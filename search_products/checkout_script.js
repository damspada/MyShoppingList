const checkout_wrapper = document.querySelector('.wrapper_checkout');
const checkout_body = document.querySelector('body');
const checkout_iconClose = document.querySelector('.icon_close_checkout');
const checkout_btnPopup = document.querySelector('.bottone_checkout');

checkout_btnPopup.addEventListener('click', ()=>{
    checkout_wrapper.classList.add('active-popup');
    checkout_body.classList.add('popup-active');
});

checkout_iconClose.addEventListener('click', ()=>{
    checkout_wrapper.classList.remove('active-popup');
    checkout_body.classList.remove('popup-active');
    hidePopup();
});
