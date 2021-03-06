let catalogToggler = document.querySelector('#catalog-toggler');
let catalog = document.querySelector('.catalog');

let lightBtn = document.querySelector('#light-mode-btn');

let aboutMsgs = document.querySelectorAll('.about-msg');

let miniImgs = document.querySelectorAll('.mini-imgs img');
let mainImg = document.querySelector('#one-product-main-img');

let mobileMenuToggler = document.querySelector('.mobile-menu-toggler');
let mobileMenuModal = document.querySelector('.mobile-menu-modal');
let mobileMenuCloseBtn = document.querySelector('.mobile-menu-modal .close-btn');

let textDropElements = document.querySelectorAll('.text-drop');

let reviewsImgsTogglers = document.querySelectorAll('.review-imgs');



if(reviewsImgsTogglers.length>0){
   reviewsImgsTogglers.forEach(item=>item.addEventListener('click',function (e){
      item.classList.toggle('review-imgs-active');
   }))
}


if(textDropElements.length>0){
   textDropElements.forEach(item=>item.addEventListener('click',function (e){
      if(e.target.tagName == 'HEADER' || e.target.tagName == 'H4'){
         item.classList.toggle('text-drop-active');
      }

   }));
}


if(mainImg != undefined){
   mainImg.src = miniImgs[0].src;
}

if(catalogToggler !== null){
   catalogToggler.addEventListener('click', function(){
      catalog.classList.toggle('catalog-active');
   });
}


if(mobileMenuCloseBtn !==null && mobileMenuToggler!==null && mobileMenuModal!==null){
   mobileMenuToggler.addEventListener('click',function (){
      mobileMenuModal.classList.toggle('mobile-menu-modal-active');
   });
   mobileMenuCloseBtn.addEventListener('click',function (){
      mobileMenuModal.classList.remove('mobile-menu-modal-active');
   });
}


if(aboutMsgs.length > 0){
   window.addEventListener('scroll',function(e){
      //TODO какая-то сомнитетельная функция
      // console.log(window.scrollY);
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
}


if(miniImgs.length>0 && mainImg!==null){
   miniImgs.forEach(item=>item.addEventListener('click',function(){
      mainImg.src = this.src;
   }));
}
