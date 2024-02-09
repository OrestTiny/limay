(function ($, window, document, undefined) {
  'use strict';

  const accordHeading = $('.limay-accordion__heading');
  const accordPopupBtn = $('#limay-accordion__popup-btn');
  const accordPopupMain = $('.limay-accordion__popup');

  if (accordHeading) {
    accordHeading.on('click', function () {
      const textAction = $('.limay-accordion__heading-action span', this);

      $(this).parent().toggleClass('open');
      $(this).next().stop(true).slideToggle();

      textAction.text(function () {
        return $(this).closest('.limay-accordion__item').hasClass('open') ? $(this).attr('data-open') : $(this).attr('data-close');
      });

    })
  }

  if (accordPopupMain) {
    $(accordPopupMain).prependTo('body');

    $('.limay-accordion__popup [data-empty-text]').text('Upload CV')

    $(document).on('mouseup', '#limay-accordion__popup-btn, #limay-accordion__popup-close', function (el) {
      accordPopupMain.toggleClass('active');
    })
  }


})(jQuery, window, document);
