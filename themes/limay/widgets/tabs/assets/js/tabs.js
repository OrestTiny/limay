(function ($, window, document, undefined) {
  'use strict';

  $('.limay-tab-links h5').on('click', function (e) {
    const currentAttrValue = $(this).attr('data-item');
    e.preventDefault();

    $('.limay-tabs ' + currentAttrValue)
      .addClass('active')
      .siblings()
      .removeClass('active');

    $(this).parent('li').addClass('active').siblings().removeClass('active');
  });
})(jQuery, window, document);
