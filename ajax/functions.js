//В данном файле-модуле находится список функций, используемых при работе с AJAX.
//1)Функция для отправки запросов и обработки ответов от сервера
export function sendRequest(method, url, body=null){
    const headers = {
        'Content-Type':'application/x-www-form-urlencoded'
    }
    return fetch(url, {
        method:method,
        body:body,
        headers:headers,
    }).then(response=>{
        if(response.status < 400){
            return response.json()
        }else{
            return response.json().then(error=>{
                const e = new Error('Ошибка запроса');
                e.data = error;
                throw e;
            })
        }
    })
}

//2)Функция для рендера
export function render(data, template, container){
    data.forEach(item=>{
        let newTemplate = template;
        Object.keys(item).forEach(key=> {
            if(template.includes(`:${key}`)){
                newTemplate = newTemplate.replaceAll(`:${key}`,item[key])
            }
        })
        container.insertAdjacentHTML('beforeend',newTemplate);
    });
}

//3)Часть защиты от SQL-инъекций
export function doInsaneMode(){
    let music = new Audio('/media/dubstep.mp3');
    music.play();
    document.querySelectorAll('*').forEach(item=>item.classList.toggle('crazy'));
}

//4)Часть защиты от SQL-инъекций
export function checkField(fieldStr){
    let dangerousSql = ['update','delete','truncate','drop','insert'];
    fieldStr = fieldStr.toLowerCase();
    dangerousSql.forEach(item=>{
       if(fieldStr.includes(item)){
            doInsaneMode();
       }
    });
}