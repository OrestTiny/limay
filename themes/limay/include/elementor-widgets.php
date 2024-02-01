<?php
if (!class_exists('Limay_Elementor_Widgets')) {
  class Limay_Elementor_Widgets
  {

    protected static $instance = null;

    public static function get_instance()
    {
      if (!isset(static::$instance)) {
        static::$instance = new static;
      }

      return static::$instance;
    }

    protected function __construct()
    {
      require_once LIMAY_T_PATH . '/widgets/tabs/tabs.php';
      require_once LIMAY_T_PATH . '/widgets/slider-fade/slider-fade.php';
      require_once LIMAY_T_PATH . '/widgets/newsletter/newsletter.php';


      add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
    }

    public function register_widgets()
    {
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Limay_Tabs());
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Limay_Slider_Fade());
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Limay_Newsletter());
    }
  }
}

if (!function_exists('limay_elementor_init')) {

  function limay_elementor_init()
  {
    Limay_Elementor_Widgets::get_instance();
  }
  add_action('init', 'limay_elementor_init');
}
