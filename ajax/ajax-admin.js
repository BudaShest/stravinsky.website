import {sendRequest,render} from '/ajax/functions.js';
const categoryInput = document.querySelector('#brands-query-input');

let brandsContainer = document.querySelector('#admin-all-brands');
let brandTemplate = "<a href='#' class='row line-row' id=':id'>" +
    "<div class='row'><img src='/imgs/admin-data/:image' alt=''></div>" +
    "<div class='row'>:cat_name</div>" +
    "<div class='row'>:name</div>" +
    "<div class='row' style='color::color'>:color</div>" +
    "</a>";

let subCategoryInput = document.querySelector('#categories-query-input');
let categoriesContainer = document.querySelector('#admin-all-categories');
let categoryTemplate = "<a href='#' class='row line-row' id=':id'>" +
    "<div class='row'>:name</div>" +
    "<div class='row'>:sub_name</div>" +
    "<div class='row' style='color::color'>:color</div>" +
    "</a>";



let productCategoryInput = document.querySelector('#product-category-input');
let productBrandInput = document.querySelector('#product-brand-input');

let productContainer = document.querySelector('#admin-all-products');
let prodBrandInput = document.querySelector('#products-brand-query-input');
let productTemplate = "<a href='#' class='row line-row' id=':id'>" +
    "<div class='row'>:name</div>" +
    "<div class='row'>:rating</div>" +
    "<div class='row'>:price руб</div>" +
    "<div class='row'>:cat_name</div>" +
    "</a>";

let appUpdateSelects = document.querySelectorAll('.application-update-select');

let applicationStatusInput = document.querySelector('#applications-status-query-input');
let applicationContainer = document.querySelector('#admin-all-applications');
let applicationTemplate = `<a class="row line-row" href="#"  id=":id">
                                <div class="row"><span>Заявка №:id</span></div>
                                <div class="row"><span>:created_at</span></div>
                                <span class="row"><span>:login</span></span>
                                <div class="row">
                                    <form action="" class="row" method="post">
                                        <input name="app_update_id" type="number" value=":id" readonly hidden>
                                        <select name="app_update_status" class="application-update-select">
                                            <option value="6">В рассмотрении</option>
                                            <option value="7">Принята</option>
                                            <option value="8">В работе</option>
                                            <option value="9">Завершена</option>
                                            <option value="10">Отменена</option>
                                        </select>
                                    </form>
                                </div>
                            </a>`;



applicationStatusInput.addEventListener('change', function (){
   let params = this.value;
   applicationContainer.innerHTML = "";

   sendRequest('POST', '/route/admin/ajax/brands-query.php','app_status_id='+params)
       .then(data=>{
           render(data,applicationTemplate,applicationContainer);
           appUpdateSelects = document.querySelectorAll('.application-update-select');

           appUpdateSelects.forEach(item=>item.addEventListener('change',function (e){
               let statusId = this.value;

               let appId = e.currentTarget.previousElementSibling.value;

               sendRequest('POST','/route/admin/ajax/brands-query.php','app_update_status='+statusId+"&app_update_id="+appId)
                   .then(data=>{
                       console.log(data);
                   })
                   .catch(err=>console.error(err))
           }));
       })
       .catch(err=>console.error(err))


});

appUpdateSelects.forEach(item=>item.addEventListener('change',function (e){
    let statusId = this.value;

    let appId = e.currentTarget.previousElementSibling.value;

    sendRequest('POST','/route/admin/ajax/brands-query.php','app_update_status='+statusId+"&app_update_id="+appId)
        .then(data=>{
            console.log(data);
        })
        .catch(err=>console.error(err))
}));

prodBrandInput.addEventListener('change',function (){
    let params = this.value;
    productContainer.innerHTML = '';
    sendRequest('POST','/route/admin/ajax/brands-query.php', 'prod_brand_id='+params)
        .then(data=>{
            render(data,productTemplate, productContainer);
        })
        .catch(err=>console.log(err))
});

productCategoryInput.addEventListener('change',function (){
    let params = this.value;
    productBrandInput.innerHTML = '';
    sendRequest('POST','/route/admin/ajax/brands-query.php','prod_category_id='+params)
        .then(data=>{
            data.forEach(item=>{
               let option = document.createElement('option');
               option.textContent = item.name;
               option.value = item.id;
               productBrandInput.append(option);
            });
        })
        .catch(err=>console.log(err))
});

categoryInput.addEventListener('change',()=>{
    let params = categoryInput.value;
    brandsContainer.innerHTML = "";
    sendRequest('POST', '/route/admin/ajax/brands-query.php','category_id='+params)
        .then(data=>{
            render(data, brandTemplate, brandsContainer);
        })
        .catch(err=>console.log(err))
});

subCategoryInput.addEventListener('change', function (){
   let params =  this.value;
   categoriesContainer.innerHTML = "";
   sendRequest('POST','/route/admin/ajax/brands-query.php','supercategory_id='+params)
       .then(data=>{
           render(data, categoryTemplate,categoriesContainer);
       })
       .catch(err=>console.log(err))
});


