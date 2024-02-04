$(document).ready(function () {

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
})