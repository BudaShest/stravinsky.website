let rotatingForm = document.querySelector('.rotating');


let authShowBtn = document.querySelector('#auth-show-btn');
let regShowBtn = document.querySelector('#reg-show-btn');

regShowBtn.addEventListener('click',function (){
   rotatingForm.classList.add('rotating-form-active');
   
});
authShowBtn.addEventListener('click',function (){
   rotatingForm.classList.remove('rotating-form-active');
});

