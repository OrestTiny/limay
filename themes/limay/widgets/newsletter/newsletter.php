<?php

namespace Elementor;

class Limay_Newsletter extends Widget_Base
{

  public function get_name()
  {
    return 'limay-newsletter';
  }

  public function get_title()
  {
    return 'Limay Newsletter';
  }

  public function get_icon()
  {
    return 'dashicons dashicons-email';
  }

  public function get_categories()
  {
    return ['general'];
  }

  public function __construct($data = [], $args = null)
  {
    parent::__construct($data, $args);
    wp_register_style('limay-newsletter', LIMAY_T_URI . '/widgets/newsletter/assets/css/newsletter.min.css');
  }


  public function get_style_depends()
  {
    return ['limay-newsletter'];
  }

  protected function _register_controls()
  {

    $this->start_controls_section(
      'section_content',
      [
        'label' => esc_html__('Content', 'limay'),
      ]
    );

    $this->add_control(
      'title',
      [
        'label' => esc_html__('Title', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Default Title', 'limay'),
        'placeholder' => esc_html__('Type your title here', 'limay'),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'description',
      [
        'label' => esc_html__('Description', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 10,
        'default' => esc_html__('Default Description', 'limay'),
        'placeholder' => esc_html__('Type your description here', 'limay'),
      ]
    );



    $this->end_controls_section();
  }

  protected function render()
  {

    $settings = $this->get_settings_for_display();

    $shortcode = cmb2_get_option('limay_main_options', 'limay_newsletter_form_shortcode');


?>
    <div class="limay-newsletter">
      <div class="limay-newsletter__wrap">
        <div class="limay-newsletter__heading inside-sec">
          <h2><?php echo $settings['title'] ?></h2>
          <p><?php echo $settings['description'] ?></p>
        </div>

        <?php if (!empty($shortcode)) { ?>
          <div class="limay-newsletter__form">
            <?= do_shortcode($shortcode); ?>
          </div>
        <?php } ?>

      </div>
    </div>
<?php
  }
}
