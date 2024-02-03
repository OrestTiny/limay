$(document).ready(function () {
  var imagesShown = [];

  function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();
    return (elemBottom <= docViewBottom);
  }

  function isScrolledIntoViewLastItem() {
    const mainImageSec = $('.shimitest-gallery__right');
    const desktopPhotos = $('.desktopPhotos');
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = mainImageSec.offset().top;
    var elemBottom = elemTop + mainImageSec.height();

    if (docViewTop + ($(window).height() / 1.5) >= elemBottom) {
      desktopPhotos.fadeOut();
    } else {
      desktopPhotos.fadeIn();
    }
  }

  function animateImages() {
    const section = $('.desktopContentSection');

    section.each(function () {
      var index = $(this).index();
      var image = $('.desktopPhotos .desktopPhoto').eq(index);

      if (isScrolledIntoView(this) && !imagesShown[index]) {
        image.addClass('active');
        imagesShown[index] = true;
      } else if (!isScrolledIntoView(this) && imagesShown[index]) {
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

      if (desktopPhotos.children().length && windowW <= 1024) {
        imageEl.appendTo($(this).children('.desktopContentSection__wrap'));
      }

      if (windowW >= 1024) {
        imageEl.appendTo(desktopPhotos);
      }
    });
  }

  $(window).on('load resize', function () {
    changePosition();
  })

  $(window).on('load scroll', function () {
    if ($(window).innerWidth() >= 1024) {
      isScrolledIntoViewLastItem()
      animateImages();
    }
  });
});