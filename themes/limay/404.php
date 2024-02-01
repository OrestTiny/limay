<?php

/**
 * 404 Page
 */

get_header(); ?>

<div class="limay-error">
  <div class="container">
    <div class="limay-error__wrap">
      <div class="limay-error__title"><?php esc_html_e('OOPS!', 'limay'); ?></div>
      <div class="limay-error__subtitle"><?php esc_html_e('404', 'limay'); ?></div>
      <h1 class="limay-error__text"><?php esc_html_e('Page not found', 'limay'); ?></h1>
      <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Go home', 'limay'); ?></a>
    </div>
  </div>
</div>

<?php get_footer();
