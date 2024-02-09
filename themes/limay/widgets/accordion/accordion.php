<?php

namespace Elementor;

class Limay_Accordion extends Widget_Base
{

  public function get_name()
  {
    return 'limay-accordion';
  }

  public function get_title()
  {
    return 'Limay Accordion';
  }

  public function get_icon()
  {
    return 'dashicons dashicons-excerpt-view';
  }

  public function get_categories()
  {
    return ['general'];
  }

  public function __construct($data = [], $args = null)
  {
    parent::__construct($data, $args);
    wp_enqueue_style('limay-accordion', LIMAY_T_URI . '/widgets/accordion/assets/css/accordion.min.css');
    wp_register_script(
      'limay-accordion',
      LIMAY_T_URI . '/widgets/accordion/assets/js/accordion.min.js'
    );
  }

  public function get_script_depends()
  {
    return ['limay-accordion'];
  }

  public function get_style_depends()
  {
    return ['limay-accordion'];
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
      'shortcode',
      [
        'label' => esc_html__('Popup Form', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
      ]
    );

    $accordion = new Repeater();

    $accordion->add_control(
      'title',
      [
        'label' => esc_html__('Title', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Default title', 'limay'),
        'placeholder' => esc_html__('Type your title here', 'limay'),
        'label_block' => true,
      ]
    );

    $accordion->add_control(
      'description',
      [
        'label' => esc_html__('Description', 'limay'),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => esc_html__('Default Description', 'limay'),
        'placeholder' => esc_html__('Type your description here', 'limay'),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'accordion',
      [
        'label'  => esc_html__('Repeater Accordion', 'limay'),
        'type'   => \Elementor\Controls_Manager::REPEATER,
        'fields' => $accordion->get_controls(),
      ]
    );



    $this->end_controls_section();
  }

  protected function render()
  {

    $settings = $this->get_settings_for_display();


?>
    <div class="limay-accordion">
      <?php foreach ($settings['accordion'] as $item) { ?>
        <div class="limay-accordion__item">
          <div class="limay-accordion__heading">
            <h3><?= $item['title'] ?></h3>

            <div class="limay-accordion__heading-action">
              <span data-open="Less Details" data-close="More Details">More Details</span>
              <svg width="12.455" height="8.692" viewBox="0 0 12.455 8.692">
                <path d="M0,0V12.455L8.692,6.092Z" transform="translate(12.455) rotate(90)" fill="#002999"></path>
              </svg>
            </div>
          </div>

          <div class="limay-accordion__content" style="display: none;">
            <?= $item['description'] ?>

            <div class="limay-accordion__content-btn">
              <button class="btn btn-pr" id="limay-accordion__popup-btn">Apply Now</button>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>


    <div class="limay-accordion__popup">
      <div class="limay-accordion__popup-content">
        <div class="limay-accordion__popup-content-wrap">
          <div class="limay-accordion__popup-left">
            <h2>Apply Now</h2>
            <h3>ROLE</h3>
            <h3>Digital Designer</h3>
            <p>Please fill in the form including your CV and we will get back to you.</p>
          </div>
          <div class="limay-accordion__popup-right">
            <div class="limay-accordion__popup-right-wrap">
              <?= do_shortcode($settings['shortcode']) ?>
            </div>
          </div>
        </div>

        <button class="limay-accordion__popup-close" id="limay-accordion__popup-close">
          <svg width="35.133" height="35.133" viewBox="0 0 35.133 35.133">
            <g id="Group_379" data-name="Group 379" transform="translate(-1330 -76.356)">
              <rect id="Rectangle_762" data-name="Rectangle 762" width="7.15" height="42.535" transform="translate(1365.133 106.433) rotate(135)" fill="#002999"></rect>
              <rect id="Rectangle_818" data-name="Rectangle 818" width="7.15" height="42.535" transform="translate(1360.077 76.356) rotate(45)" fill="#002999"></rect>
            </g>
          </svg>
        </button>
      </div>
      <div class="limay-accordion__popup-bg"></div>
    </div>
<?php
  }
}
