let menuToggler = document.querySelector('.menu-toggler');
let modalMenu = document.querySelector('.admin-modal');
let adminModalCloseBtn = document.querySelector('#admin-modal-close');

let allSections = document.querySelectorAll('section');
let allSectionTogglers = document.querySelectorAll('.admin-modal ul li a');

let allRecords = document.querySelectorAll('.all-records');
let contextMenu = document.querySelector('.modal-context-menu');
let contextTableInput = document.querySelector('#context-table-name');
let contextIdInput = document.querySelector('#context-table-id');

let bannerImgInput = document.querySelector('#banner-img-input');
let bannerStrImgInput = document.querySelector('#banner-img-str');

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



allRecords.forEach(item=>item.addEventListener('contextmenu',function (e){
    e.preventDefault();
    contextMenu.classList.toggle('modal-context-menu-active');
    contextMenu.style.top = e.pageY + "px";
    contextMenu.style.left = e.pageX + "px";
    contextIdInput.value = e.target.closest('.line-row').id;

}));