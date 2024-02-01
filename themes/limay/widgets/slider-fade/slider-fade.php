<?php

namespace Elementor;

class Limay_Slider_Fade extends Widget_Base
{

  public function get_name()
  {
    return 'limay-slider-fade';
  }

  public function get_title()
  {
    return 'Limay Fade Slider';
  }

  public function get_icon()
  {
    return 'dashicons dashicons-slides';
  }

  public function get_categories()
  {
    return ['general'];
  }

  public function __construct($data = [], $args = null)
  {
    parent::__construct($data, $args);
    wp_register_style('limay-slider-fade', LIMAY_T_URI . '/widgets/slider-fade/assets/css/slider-fade.min.css');
    wp_register_script(
      'limay-slider-fade',
      LIMAY_T_URI . '/widgets/slider-fade/assets/js/slider-fade.min.js',
      array('swiper'),
      '',
      true
    );
  }

  public function get_script_depends()
  {
    return ['limay-slider-fade'];
  }

  public function get_style_depends()
  {
    return ['limay-slider-fade'];
  }

  protected function _register_controls()
  {

    $this->start_controls_section(
      'section_content',
      [
        'label' => esc_html__('Content', 'limay'),
      ]
    );

    $slides = new Repeater();

    $slides->add_control(
      'media',
      [
        'label'       => esc_html__('Media', 'limay'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'placeholder' => esc_html__('Select image', 'limay'),
        'show_label' => false,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $slides->add_control(
      'title',
      [
        'label' => esc_html__('Title', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Default Title', 'limay'),
        'placeholder' => esc_html__('Type your title here', 'limay'),
        'label_block' => true,
      ]
    );

    $slides->add_control(
      'subtitle',
      [
        'label' => esc_html__('Subtitle', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => esc_html__('Default Subtitle', 'limay'),
        'placeholder' => esc_html__('Type your subtitle here', 'limay'),
        'label_block' => true,
      ]
    );

    $slides->add_control(
      'description',
      [
        'label' => esc_html__('Description', 'limay'),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'rows' => 10,
        'default' => esc_html__('Default Description', 'limay'),
        'placeholder' => esc_html__('Type your description here', 'limay'),
      ]
    );

    $this->add_control(
      'slides',
      [
        'label'  => esc_html__('Repeater Slides', 'limay'),
        'type'   => \Elementor\Controls_Manager::REPEATER,
        'fields' => $slides->get_controls(),
      ]
    );

    $this->end_controls_section();
  }

  protected function render()
  {

    $settings = $this->get_settings_for_display();

?>
    <div class="limay-slider-fade">
      <?php if (!empty($settings['slides']) && is_array($settings['slides']) && count($settings['slides'])) { ?>
        <div class="swiper limay-slider-fade__first">
          <div class="swiper-wrapper">
            <?php foreach ($settings['slides'] as $i) { ?>
              <div class="swiper-slide">
                <div class="limay-slider-fade__item media-fit">
                  <?php echo wp_get_attachment_image($i['media']['id'], 'full', array('loading' => 'lazy',)); ?>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>

        <div class="limay-slider-fade__second">
          <div class="limay-slider-fade__button">
            <button class="swiper-button-prev">
              <i class="icon-arrow-left"></i>
            </button>
            <button class="swiper-button-next">
              <i class="icon-arrow-right"></i>
            </button>
          </div>

          <div class="swiper">
            <div class="swiper-wrapper">
              <?php foreach ($settings['slides'] as $i) { ?>
                <div class="swiper-slide">
                  <div class="limay-slider-fade__item">
                    <?php if (!empty($i['title'])) { ?>
                      <h2 class="inside-sec"><?php echo esc_html__($i['title'], 'limay'); ?></h2>
                    <?php } ?>

                    <?php if (!empty($i['subtitle'])) { ?>
                      <p class="limay-slider-fade__subtitle"><?php echo esc_html__($i['subtitle'], 'limay'); ?></p>
                    <?php } ?>

                    <?php if (!empty($i['description'])) { ?>
                      <div class="limay-slider-fade__description">
                        <?php echo wp_kses_post($i['description'], 'limay'); ?>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
<?php
  }
}
