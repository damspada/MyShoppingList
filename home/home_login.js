const wrapper=document.querySelector('.wrapper');
const loginLink=document.querySelector('.login-link');
const registerLink=document.querySelector('.register-link');
const iconClose= document.querySelector('.icon-close');
const btnPopup=document.querySelector('.Btn');


registerLink.addEventListener('click', ()=>{
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', ()=>{
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', ()=>{
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', ()=>{
    wrapper.classList.remove('active-popup');
    hidePopup();
});

// function showPopup(){
//     document.getElementById('overlay').style.display = 'block';

//     document.body.classList.add('active-popup');
// }

// function hidePopup(){
//     document.getElementById('overlay').style.display = 'none';

//     document.body.classList.remove('active-popup');
// }

// document.getElementById('Btn').addEventListener('click', function(){
//     showPopup();
// })

// document.getElementById('btn').addEventListener('click', function(){
//     hidePopup();
// })
