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
$copy = cmb2_get_option('limay_main_options', 'limay_footer_copyright');
$custom_logo_id = get_theme_mod('custom_logo');
$logo = wp_get_attachment_image_src($custom_logo_id, 'full');


?>

</main>

<footer class="limay-footer">
  <div class="container">
    <div class="limay-footer__wrap">
      <div class="limay-footer__wrap-left">
        <!-- <a class="limay-footer__logo" href="<?php echo esc_url(home_url('/')); ?>">
          <?php
          if (has_custom_logo()) {
            echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
          }
          ?>
        </a> -->

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

    </div>


    <div class="limay-footer__wrap-bottom">
      <div class="limay-footer__copyright"><?= $copy ?></div>

      <?php if (has_nav_menu('footer-menu-sec')) {
        $args = array(
          'container_class' => 'limay-footer__menu-sec',
          'container' => 'nav',
          'menu_class' => 'footer-menu-sec',
          'theme_location' => 'footer-menu-sec'
        );
        wp_nav_menu($args);
      }  ?>
    </div>
  </div>
</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>