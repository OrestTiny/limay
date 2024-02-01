(function ($, window, document, undefined) {
  'use strict';

  new Swiper('.limay-slider-fade .limay-slider-fade__first', {
    fadeEffect: { crossFade: true },
    effect: 'fade',
    slidersPerView: 1,
    virtualTranslate: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: true,
    },
    speed: 1000,
    allowTouchMove: false,
    loop: true,
    navigation: {
      nextEl: '.limay-slider-fade .swiper-button-next',
      prevEl: '.limay-slider-fade .swiper-button-prev',
    },
  });

  new Swiper('.limay-slider-fade .limay-slider-fade__second .swiper', {
    fadeEffect: { crossFade: true },
    effect: 'fade',
    slidersPerView: 1,
    virtualTranslate: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: true,
    },
    speed: 1000,
    allowTouchMove: false,
    loop: true,
    navigation: {
      nextEl: '.limay-slider-fade .swiper-button-next',
      prevEl: '.limay-slider-fade .swiper-button-prev',
    },
  });
})(jQuery, window, document);
