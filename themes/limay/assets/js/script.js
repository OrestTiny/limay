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



  const loadAnimation = () => {
    debugger;
    const headerMenuItems = $('.header-menu .menu-item');

    headerMenuItems.each(function (i) {
      setTimeout(() => {
        $(this).addClass('animation');
      }, i * 100);
    })
  }

  loadAnimation();





  const aniItems = $('[data-an]');

  if (aniItems) {
    aniItems.each((i, el) => {
      const delay = $(el).attr('data-anDelay');

      if (delay) {
        setTimeout(() => {
          $(el).addClass('animation')
        }, delay);
      } else {
        $(el).addClass('animation')
      }
    })
  }














  let Scrollbar = window.Scrollbar;
  let options = {
    damping: '0.05',
    alwaysShowTracks: true,
  };

  let scrollbarInstance = Scrollbar.init(document.querySelector('.limay-main'), options);

  scrollbarInstance.addListener((status) => {

    if ($(window).innerWidth() >= 991 && $('.shimitest-gallery').length) {
      isScrolledIntoViewLastItem(status.offset.y)
      animateImages();
      isScrollPosition();
    }

  });

  var imagesShown = [];

  function isScrollPosition() {
    const windowHeight = $(window).height();
    const shimiGallery = $('.shimitest-gallery');
    const wrap = $('.desktopPhotos');
    const positionCenter = (windowHeight - wrap.outerHeight()) / 2;

    const startAnimationNew = shimiGallery.offset().top - positionCenter;
    const endAnimationNew = shimiGallery.offset().top + shimiGallery.outerHeight() - windowHeight + positionCenter;

    if (startAnimationNew <= 0 && endAnimationNew >= 0) {
      let positiveValue = Math.abs(startAnimationNew);

      wrap.css({
        transform: `translateY(${positiveValue}px)`
      });
    }
  }

  function isScrolledIntoView(elem) {
    const elemTop = elem.offset().top;
    const elemBottom = elemTop - $(window).outerHeight();

    return (elemBottom <= 0);
  }

  function isScrolledIntoViewLastItem() {
    const mainImageSec = $('.shimitest-gallery__right');
    const desktopPhotos = $('.desktopPhotos');
    const elemTop = mainImageSec.offset().top;
    const elemBottom = elemTop + mainImageSec.height() - $(window).height() / 1.5;

    if (elemBottom <= 0) {
      desktopPhotos.fadeOut();
    } else {
      desktopPhotos.fadeIn();
    }
  }

  function animateImages() {
    const section = $('.desktopContentSection__wrap');

    section.each(function (index) {
      var image = $('.desktopPhotos .desktopPhoto').eq(index);

      if (isScrolledIntoView($(this)) && !imagesShown[index]) {
        image.addClass('active');
        imagesShown[index] = true;
      } else if (!isScrolledIntoView($(this)) && imagesShown[index]) {
        image.removeClass('active');
        imagesShown[index] = false;
      }
    });
  }

  function changePosition() {
    const windowW = $(window).innerWidth();
    const desktopContentSection = $('.desktopContentSection');
    const desktopPhoto = $('.desktopPhoto');
    const desktopPhotos = $('.desktopPhotos');

    desktopContentSection.each(function () {
      const index = $(this).index();
      const imageEl = desktopPhoto.eq(index);

      if (desktopPhotos.children().length && windowW <= 991) {
        imageEl.appendTo($(this).children('.desktopContentSection__wrap'));
        desktopPhotos.removeAttr('style');
      }

      if (windowW >= 991) {
        imageEl.appendTo(desktopPhotos);
      }
    });
  }

  $(window).on('load resize', function () {
    changePosition();
  })


});
