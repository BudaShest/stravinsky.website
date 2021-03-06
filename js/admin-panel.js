let menuToggler = document.querySelector('.menu-toggler');
let modalMenu = document.querySelector('.admin-modal');
let adminModalCloseBtn = document.querySelector('#admin-modal-close');

let allSections = document.querySelectorAll('section');
let allSectionTogglers = document.querySelectorAll('.admin-modal ul li a');
let startSection = document.querySelector('#admin-main-start');

let allRecords = document.querySelectorAll('.all-records');
let contextMenu = document.querySelector('.modal-context-menu');
let contextTableInput = document.querySelector('#context-table-name');
let contextIdInput = document.querySelector('#context-table-id');

let bannerImgInput = document.querySelector('#banner-img-input');
let bannerStrImgInput = document.querySelector('#banner-img-str');

window.addEventListener('DOMContentLoaded', function (){
    console.log();
})

if(bannerImgInput && bannerStrImgInput){
    bannerImgInput.addEventListener('change',function (){
        bannerStrImgInput.value = this.files[0]['name'];
    });
}

if(menuToggler !== null){
    menuToggler.addEventListener('click',function (){
        modalMenu.classList.toggle('admin-modal-active');
    });

}

if(allSectionTogglers.length > 0){
    allSectionTogglers.forEach(item=>item.addEventListener('click',function (e){
        allSections.forEach(item=>item.style.display = "none");
        let selector = "#"+e.currentTarget.dataset.section;

        contextTableInput.value = e.currentTarget.dataset.section;

        document.querySelector(selector).style.display = "flex";
        modalMenu.classList.remove('admin-modal-active');

    }));
}else{
    contextTableInput.value = "admin-one-user-settings";
}


if(adminModalCloseBtn!==null){
    adminModalCloseBtn.addEventListener('click',function (){
        modalMenu.classList.remove('admin-modal-active');
    });
}


if(allRecords!==null){
    allRecords.forEach(item=>item.addEventListener('contextmenu',function (e){
        e.preventDefault();
        if(!e.target.closest('.line-row').classList.contains('line-row-example')){
            if(e.target.closest('.line-row').dataset.isreview == "true"){
                contextTableInput.value = "admin-one-user-settings-rev";
            }
            contextMenu.classList.toggle('modal-context-menu-active');
            contextMenu.style.top = e.pageY + "px";
            contextMenu.style.left = e.pageX + "px";
            contextIdInput.value = e.target.closest('.line-row').id;
        }else{
            contextMenu.classList.remove('modal-context-menu-active');
        }

    }));
}
