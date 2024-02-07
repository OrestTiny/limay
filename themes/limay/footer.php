<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Limay
 */



$social = cmb2_get_option('limay_main_options', 'limay_social_group');

?>

</main>

<footer class="limay-footer">

  <div class="limay-footer__wrap">
    <h4>FOLLOW</h4>
    <ul class="limay-footer__social">
      <?php if (!empty($social)) { ?>
        <?php foreach ($social as $item) { ?>
          <li>
            <a href="<?php echo esc_url($item['limay_social_group_link']); ?>" title="<?php echo esc_html($item['limay_social_group_name']); ?>" aria-label="<?php echo esc_html($item['limay_social_group_name']); ?>" target="_blank" rel="noopener">
              <?php echo file_get_contents(get_template_directory() . '/assets/images/icons/' . $item['limay_social_group_icon'] . '.svg'); ?>
            </a>
          </li>
        <?php } ?>
      <?php } ?>
    </ul>
  </div>

  <?php if (has_nav_menu('footer-menu')) {
    $args = array(
      'container_class' => 'limay-footer__menu',
      'container' => 'nav',
      'menu_class' => 'footer-menu',
      'theme_location' => 'footer-menu'
    );
    wp_nav_menu($args);
  }  ?>


</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>