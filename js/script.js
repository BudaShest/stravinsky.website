let catalogToggler = document.querySelector('#catalog-toggler');
let catalog = document.querySelector('.catalog');

let userInfoToggler = document.querySelector('.current-user-info');
let userInfoForm = document.querySelector('.user-info-form');

let lightBtn = document.querySelector('#light-mode-btn');

let aboutMsgs = document.querySelectorAll('.about-msg');

let miniImgs = document.querySelectorAll('.mini-imgs img');
let mainImg = document.querySelector('#one-product-main-img');

if(mainImg != undefined){
   mainImg.src = miniImgs[0].src;
}

if(catalogToggler !== null){
   catalogToggler.addEventListener('click', function(){
      catalog.classList.toggle('catalog-active');
   });
}


let mobileMenuToggler = document.querySelector('.mobile-menu-toggler');
let mobileMenuModal = document.querySelector('.mobile-menu-modal');
let mobileMenuCloseBtn = document.querySelector('.mobile-menu-modal .close-btn');

mobileMenuToggler.addEventListener('click',function (){
   mobileMenuModal.classList.toggle('mobile-menu-modal-active');
});
mobileMenuCloseBtn.addEventListener('click',function (){
   mobileMenuModal.classList.remove('mobile-menu-modal-active');
});

// userInfoToggler.addEventListener('click',function (){
//    userInfoForm.classList.toggle('current-user-control-active');
// });

// let windowShowHeight = 2800;
window.addEventListener('scroll',function(e){
   //TODO какая-то сомнитетельная функция
   console.log(window.scrollY);
   if(window.scrollY >= 2250){
      aboutMsgs[0].classList.add('about-msg-active');
   }
   if(window.scrollY >= 2400){
      aboutMsgs[1].classList.add('about-msg-active');
   }
   if(window.scrollY >= 2700){
      aboutMsgs[2].classList.add('about-msg-active');
   }
   if(window.scrollY >= 3000){
      aboutMsgs[3].classList.add('about-msg-active');
   }
   if(window.scrollY >= 3200){
      aboutMsgs[4].classList.add('about-msg-active');
   }
   if(window.scrollY >= 3400){
      aboutMsgs[5].classList.add('about-msg-active');
   }

});

lightBtn.addEventListener('click',function (){
   let music = new Audio('../media/dubstep.mp3');
   music.play();
   document.querySelectorAll('*').forEach(item=>item.classList.toggle('crazy'));
});

miniImgs.forEach(item=>item.addEventListener('click',function(){
   mainImg.src = this.src;
}));