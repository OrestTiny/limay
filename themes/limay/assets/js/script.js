$(document).ready(function () {

  const burgerBtn = $('#limay-header__burger');
  const header = $('.limay-header');
  const megamenu = $('#limay-header__megamenu')
  const html = $('html');
  let isAnimating = false;
  let isClick = true;

  if (burgerBtn && megamenu) {
    const menuItems = $('.header-megamenu .menu-item', megamenu);
    const socialItems = $('.limay-header__megamenu-social li');
    const logo = $('.limay-header__megamenu-logo');
    const button = $('.limay-header__megamenu-btn');

    burgerBtn.click(function () {
      if (!isClick) return;
      isClick = false;

      if (!isAnimating) {
        isAnimating = true;

        burgerBtn.addClass('active');
        html.addClass('no-scroll');

        megamenu.addClass('open');
        header.addClass('open')
        logo.addClass('active');

        setTimeout(() => {
          button.addClass('active');
          animateEachActive(menuItems, 100);
          animateEachActive(socialItems, 200);
          isClick = true;
        }, 300)
      } else {
        isAnimating = false;

        burgerBtn.removeClass('active');

        setTimeout(() => {
          button.removeClass('active');
          animateEachActiveReverse(menuItems, 100);
          animateEachActiveReverse(socialItems, 100)
        }, 100)

        setTimeout(() => {
          logo.removeClass('active');
        }, 600)

        setTimeout(() => {
          megamenu.removeClass('open');
          html.removeClass('no-scroll');
        }, 700)

        setTimeout(() => {
          header.removeClass('open');
          isClick = true;
        }, 1000)
      }

    });
  }


  function animateEachActive(items, duration) {
    items.each(function (index) {
      var $th = $(this);

      setTimeout(function () {
        $th.addClass('active');
      }, index * duration);
    })
  }

  function animateEachActiveReverse(items, duration) {
    var totalItems = items.length;

    items.each(function (index) {
      var $th = $(this);
      setTimeout(function () {
        $th.removeClass('active');
      }, (totalItems - index) * duration);
    });
  }

});
