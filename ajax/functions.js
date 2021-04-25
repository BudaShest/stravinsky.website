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