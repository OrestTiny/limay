$(document).ready(function () {

  const burgerBtn = $('#limay-header__burger');
  const header = $('.limay-header');
  const megamenu = $('#limay-header__megamenu')
  const html = $('html');

  if (burgerBtn && megamenu) {
    burgerBtn.click(function () {
      const th = $(this);
      console.log(1);

      html.stop('true').toggleClass('no-scroll');
      megamenu.stop(true).toggleClass('open')
      header.stop(true).toggleClass('open')


      // megamenu.animate({

      // }, {
      //   step: function (now, fx) {
      //     $(this).css({ "transform": "translate3d(0px, 0px, 0px)" });
      //   },
      //   duration: 1000,
      //   easing: 'linear',
      //   queue: false,
      //   complete: function () {
      //     alert('Animation is done');
      //   }
      // }, 'linear');
    });
  }
});
