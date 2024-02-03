<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Limay
 */
add_action('widgets_init', 'upqode_widgets_init');
add_action('wp_enqueue_scripts', 'upqode_enqueue_scripts', 999);
add_action('after_setup_theme', 'upqode_register_nav_menu', 0);
add_action('enqueue_block_editor_assets', 'upqode_add_gutenberg_assets');

/**
 * Register nav menu.
 */
if (!function_exists('upqode_register_nav_menu')) {
  function upqode_register_nav_menu()
  {
    register_nav_menus(array(
      'primary-menu' => esc_html__('Header Menu', 'limay'),
      'footer-menu' => esc_html__('Footer Menu', 'limay'),
      'footer-menu-sec' => esc_html__('Footer Secondary Menu', 'limay')
    ));
  }
}

/**
 * Register widget area.
 */
if (!function_exists('upqode_widgets_init')) {
  function upqode_widgets_init()
  {
    register_sidebar(array(
      'name'          => esc_html__('Sidebar', 'limay'),
      'id'            => 'limay-sidebar',
      'description'   => esc_html__('Add widgets here.', 'limay'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    ));
  }
}


/**
 * Enqueue scripts and styles.
 */
if (!function_exists('upqode_enqueue_scripts')) {
  function upqode_enqueue_scripts()
  {
    $blog_page = is_archive() || is_author() || is_category() || is_home() || is_tag() || is_search();

    if ((is_admin())) {
      return;
    }
    wp_enqueue_style('limay-sofia-pro', LIMAY_T_URI . '/assets/fonts/SofiaPro/stylesheet.css');
    wp_enqueue_style('limay-circularStd', LIMAY_T_URI . '/assets/fonts/CircularStd/stylesheet.css');

    if (is_404()) {
      wp_enqueue_style('limay-error-page', LIMAY_T_URI . '/assets/css/error-page.min.css');
    }

    if ($blog_page) {
      wp_enqueue_style('limay-blog-list', LIMAY_T_URI . '/assets/css/blog.min.css');
    }

    if (is_active_sidebar('limay-sidebar') && $blog_page) {
      wp_enqueue_style('limay-sidebar', LIMAY_T_URI . '/assets/css/sidebar.min.css');
    }

    if (is_single()) {
      wp_enqueue_style('limay-blog-single', LIMAY_T_URI . '/assets/css/single.min.css');
    }

    wp_enqueue_style('limay-iconmoon', LIMAY_T_URI . '/assets/fonts/iconmoon/style.css');
    wp_enqueue_style('limay-main-style', LIMAY_T_URI . '/assets/css/style.min.css');
    wp_enqueue_style('limay-style', LIMAY_T_URI . '/style.css');

    wp_localize_script(
      'limay-script',
      'get',
      array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'siteurl' => get_template_directory_uri(),
      )
    );

    if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('limay-script', LIMAY_T_URI . '/assets/js/script.min.js', array('jquery'), '', true);
  }
}

/**
 * Add backend styles for Gutenberg.
 */
if (!function_exists('upqode_add_gutenberg_assets')) {
  function upqode_add_gutenberg_assets()
  {
    wp_enqueue_style('limay-gutenberg', LIMAY_T_URI . '/assets/css/gutenberg.min.css');
  }
}
