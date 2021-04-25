import {sendRequest, render} from "/ajax/functions.js";
let superCatLinks = document.querySelectorAll('.super-category-link');
let categoriesContainer = document.querySelector('#main-all-categories');

let catLinkTemplate = "<li><a href='/route/catalog/index.php?category_id=:id'>:name</a></li>"

superCatLinks.forEach(item=>item.addEventListener('click',function (e){
    e.preventDefault();
    categoriesContainer.innerHTML = '';
    let params = this.dataset.superId;
    sendRequest('POST','/route/admin/ajax/brands-query.php','main_supercat_id='+params)
        .then(data=>{
            render(data,catLinkTemplate,categoriesContainer)
        })
        .catch(err=>console.log(err))
}))

let catalogBrandSelect = document.querySelector('#catalog-brand-select');
let catalogContainer = document.querySelector('.catalog-products-container');
let productTemplate = `<a href="/route/product/index.php?product_id=:id">
                            <div class="product col">
                                <div class="front col">
                                    <h4>:name</h4>
                                    <span class="product-category">:cat_name</span>
                                    <img src="/imgs/admin-data/:image" alt="Картинка товара">
                                    <span>:rating</span>
                                    <div class="row">
                                        <span class="old-price"><strike>:price руб.</strike></span><span class="new-price">:price руб.</span>
                                    </div>
                                </div>
                                <div class="back col">
                                    <p>${':description'.slice(0,600)}...</p>
                                </div>
                            </div>
                        </a>`;

if(catalogBrandSelect != null){
    catalogBrandSelect.addEventListener('change',function (){
        catalogContainer.innerHTML = "";
        let params = this.value;
        sendRequest('POST','/route/admin/ajax/brands-query.php','catalog_brand_id='+params)
            .then(data=>{
                render(data,productTemplate,catalogContainer)
            })
            .catch(err=>console.log(err))
    });
}


let mobileSupercatSelect = document.querySelector('#mobile-supercat-menu');
mobileSupercatSelect.addEventListener('change',function (){
    categoriesContainer.innerHTML = '';
    let params = this.value;
    sendRequest('POST','/route/admin/ajax/brands-query.php','main_supercat_id='+params)
        .then(data=>{
            render(data,catLinkTemplate,categoriesContainer)
        })
        .catch(err=>console.log(err))
});




