import {sendRequest,render, checkField} from '/ajax/functions.js';

let registerForm = document.querySelector('#register-form');
let regLoginInput = document.querySelector('#user-login-input');
let loginCheck = false;
let regEmailInput = document.querySelector('#user-email-input');
let emailCheck = false;
let regPasswordInput = document.querySelector('#user-password-input');
let passwordCheck = false;
let regConfirmPasswordInput = document.querySelector('#user-password-confirm-input');
let passwordConfirmCheck = false;

function validateForm(){
    if(loginCheck && emailCheck && passwordCheck && passwordConfirmCheck){
        return true;
    }else{
        alert('Заполните данные формы корректно');
        return false;
    }
}

registerForm.onsubmit = function (){
    return validateForm();
}

regLoginInput.addEventListener('change',function (){
   let params = this.value.trim();

   checkField(params);

   sendRequest('POST','/route/auth/ajax/validate-queries.php','register-login='+params)
       .then(data=>{
          if(Object.keys(data).includes('error')){
              loginCheck = false;
              this.previousElementSibling.textContent = data['error'];
              setTimeout(function (){
                  regLoginInput.previousElementSibling.textContent = '';
              },10000)
          }else{
              regLoginInput.previousElementSibling.textContent = '';
              loginCheck = true;
          }
       })
       .catch(err=>console.error(err))
});

regPasswordInput.addEventListener('change',function (){
   let params = this.value.trim();
   checkField(params);
   sendRequest('POST','/route/auth/ajax/validate-queries.php', 'register-password='+params)
       .then(data=>{
           if(Object.keys(data).includes('error')){
               passwordCheck = false;
                this.previousElementSibling.textContent = data['error'];
               setTimeout(function (){
                   regPasswordInput.previousElementSibling.textContent = '';
               },10000)
           }else{
               regPasswordInput.previousElementSibling.textContent = '';
               passwordCheck = true;
           }

       })
       .catch(err=>console.error(err))
})

regEmailInput.addEventListener('change',function (){
   let params = this.value.trim();
   checkField(params);
   sendRequest('POST','/route/auth/ajax/validate-queries.php', 'register-email='+params)
       .then(data=>{
           if(Object.keys(data).includes('error')){
               emailCheck = false;
               this.previousElementSibling.textContent = data['error'];
               setTimeout(function (){
                   regEmailInput.previousElementSibling.textContent = '';
               },10000)
           }else{
               regEmailInput.previousElementSibling.textContent = '';
               emailCheck = true;
           }

       })
       .catch(err=>console.error(err))
})

regConfirmPasswordInput.addEventListener('change',function (){
    if(regPasswordInput.value === this.value){
        regConfirmPasswordInput.previousElementSibling.textContent = '';
        passwordConfirmCheck = true;
    }else{
        this.previousElementSibling.textContent = 'Пароли не совпадают';
        setTimeout(function (){
            regConfirmPasswordInput.previousElementSibling.textContent = '';
        },10000)
        passwordConfirmCheck = false;
    }
});