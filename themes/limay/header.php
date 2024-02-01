<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Limay
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="theme-color" content="#ffffff">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php wp_body_open();

  $alarm = '<h4>' . esc_html__('Please register Top Navigation from', 'limay') . ' <a href="' . esc_url(admin_url('nav-menus.php')) . '" target="_blank">' . esc_html__('Appearance &gt; Menus', 'limay') . '</a></h4>';

  $custom_logo_id = get_theme_mod('custom_logo');
  $logo = wp_get_attachment_image_src($custom_logo_id, 'full');


  $btn_name = cmb2_get_option('limay_main_options', 'limay_header_btn_name');
  $btn_link = cmb2_get_option('limay_main_options', 'limay_header_btn_link');
  ?>
  <div class="limay-overlay"></div>
  <div class="limay-main">
    <header class="limay-header">
      <div class="container">
        <div class="limay-header__wrapper">
          <a class="limay-header__logo" href="<?php echo esc_url(home_url('/')); ?>">
            <?php
            if (has_custom_logo()) {
              echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
            }
            ?>
          </a>

          <?php if (has_nav_menu('primary-menu')) {
            $args = array(
              'container_class' => 'limay-header__menu',
              'container' => 'nav',
              'menu_class' => 'header-menu',
              'theme_location' => 'primary-menu',
              'walker' => new Custom_Walker_Nav_Menu(),
            );
            wp_nav_menu($args);
          } else {
            echo wp_kses_post($alarm);
          } ?>

          <?php if ($btn_name) { ?>
            <div class="limay-header__button">
              <a class="btn" target="_blank" rel="noopener" href="<?= esc_url($btn_link) ?>"><?= esc_html($btn_name, 'limay') ?></a>
            </div>
          <?php  } ?>

          <div class="limay-header__burger">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div>
    </header>
    <main>