 var swiper = new Swiper('.swiper-container', {
      direction: 'horizontal',
      autoClose: true,
      speed: 2500,
      autoplay: true,
      grabCursor:true,
      loop:true,
      arrows:true,
      spaceBetween: 30,
      effect: "fade",
      slidesPerView: 'auto',
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });