const emailInput = document.querySelector('#user-email-input');
const emailConfirmInput = document.querySelector('#user-email-code');
const confirmCodeInput = document.querySelector('#user-code-confirm');


const url = "/route/auth/mail-confirm.php";
const emailConfirmBlock = document.querySelector('.email-register-confirm');

////Старый код
// emailInput.addEventListener('change',function (){
//     emailConfirmBlock.classList.add('email-register-confirm-active');
//     params += this.value;
//     request.open('POST',url,true);
//     request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
//     request.addEventListener('readystatechange',()=>{
//         if(request.readyState === 4 && request.status === 200){
//             // console.log(request.responseText);
//             emailConfirmInput.value = request.responseText;
//         }
//     });
//     request.send(params)
// });
//
// confirmCodeInput.addEventListener('change',function (){
//     emailConfirmBlock.classList.remove('email-register-confirm-active');
// });

emailInput.addEventListener('change',()=>{
    emailConfirmBlock.classList.add('email-register-confirm-active');
    let params = emailInput.value; //TODO какая нибудь валидация

    sendMailRequest('POST', url,"mail=" + params)
        .then(data=>emailConfirmInput.value = data)
        .catch(err=>console.error(err))

});

confirmCodeInput.addEventListener('change',function (){
    emailConfirmBlock.classList.remove('email-register-confirm-active');
});

function sendMailRequest(method, url, body=null){
    const headers = {
        'Content-Type':'application/x-www-form-urlencoded'
    }

    return fetch(url, {
        method:method,
        body:body,
        headers:headers,
    }).then(response=>{
        if(response.status < 400){
            return response.text()
        }else{
            return response.text().then(error=>{
                const e = new Error('Ошибка запроса');
                e.data = error;
                throw e;
            })
        }
    })
}

