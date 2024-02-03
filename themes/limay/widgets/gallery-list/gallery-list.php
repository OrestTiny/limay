<?php

namespace Elementor;

class Limay_Gallery_List extends Widget_Base
{

  public function get_name()
  {
    return 'limay-gallery-list';
  }

  public function get_title()
  {
    return 'Limay Gallery List';
  }

  public function get_icon()
  {
    return 'dashicons dashicons-images-alt';
  }

  public function get_categories()
  {
    return ['general'];
  }

  public function __construct($data = [], $args = null)
  {
    parent::__construct($data, $args);
    wp_register_style('limay-gallery-list', LIMAY_T_URI . '/widgets/gallery-list/assets/css/gallery-list.min.css');
    wp_register_script(
      'limay-gallery-list',
      LIMAY_T_URI . '/widgets/gallery-list/assets/js/gallery-list.min.js',
      array('swiper'),
      '',
      true
    );
  }

  public function get_script_depends()
  {
    return ['limay-gallery-list'];
  }

  public function get_style_depends()
  {
    return ['limay-gallery-list'];
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
    <div class="limay-gallery-list">

      <div class="shimitest-gallery">
        <div class="shimitest-gallery__left">
          <div class="desktopContent">
            <div class="desktopContentSection">
              <div class="desktopContentSection__wrap">
                <span>01</span>
                <h2>1. Matching Ready Buyers with Leading Brands</h2>
                <p>We leverage big data and cutting-edge technology to identify and engage high-potential buyers. Using
                  predictive analysis, we anticipate future user behavior and strategically connect them with the best
                  offers.
                </p>
              </div>
            </div>
            <div class="desktopContentSection">
              <div class="desktopContentSection__wrap">
                <span>02</span>
                <h2>2. Guiding Users Purchase Journey</h2>
                <p>We employ state-of-the-art machine learning innovations to pinpoint customers based on their search
                  patterns.
                  Our aim is to empower users with data-driven insights, guiding them towards well-informed purchase
                  decisions based on their unique preferences and patterns. design agency, we love to deliver meaningful and
                  intuitive user experiences that build trust with your target audience.</p>
              </div>
            </div>
            <div class="desktopContentSection">
              <div class="desktopContentSection__wrap">
                <span>03</span>
                <h2>3. Building Impactful Content to Elevate Top Brands</h2>
                <p>We employ advanced tools, including AI-driven content generators, to craft compelling and high-quality
                  content that resonates with diverse audiences. Our brand assessments guide users in finding
                  the perfect match for their needs and provide access to exclusive offers, elevating their overall shopping
                  experience.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="shimitest-gallery__right">
          <div class="shimitest-gallery__right-wrap">
            <div class="desktopPhotos">
              <div class="desktopPhoto "><img src="https://shimitest.com/wp-content/uploads/2023/12/homepage-img-1.webp">
              </div>
              <div class="desktopPhoto "><img src="https://shimitest.com/wp-content/uploads/2023/12/homepage-img-2.jpg">
              </div>
              <div class="desktopPhoto "><img src="https://shimitest.com/wp-content/uploads/2023/12/homepage-img-3.jpg">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
