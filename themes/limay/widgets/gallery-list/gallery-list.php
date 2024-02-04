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
    wp_enqueue_style('limay-gallery-list', LIMAY_T_URI . '/widgets/gallery-list/assets/css/gallery-list.min.css', [], false);

    wp_register_script(
      'limay-gallery-list',
      LIMAY_T_URI . '/widgets/gallery-list/assets/js/gallery-list.min.js',
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

    $list = new Repeater();

    $list->add_control(
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

    $list->add_control(
      'title',
      [
        'label' => esc_html__('Title', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => esc_html__('Default Title', 'limay'),
        'rows' => 10,
        'placeholder' => esc_html__('Type your title here', 'limay'),
        'label_block' => true,
      ]
    );


    $list->add_control(
      'description',
      [
        'label' => esc_html__('Description', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 10,
        'default' => esc_html__('Default Description', 'limay'),
        'placeholder' => esc_html__('Type your description here', 'limay'),
      ]
    );

    $this->add_control(
      'list',
      [
        'label'  => esc_html__('Repeater Slides', 'limay'),
        'type'   => \Elementor\Controls_Manager::REPEATER,
        'fields' => $list->get_controls(),
      ]
    );

    $this->end_controls_section();
  }

  protected function render()
  {

    $settings = $this->get_settings_for_display();

    $list = $settings['list'];



?>
    <div class="limay-gallery-list">
      <div class="shimitest-gallery">
        <div class="shimitest-gallery__left">
          <div class="desktopContent">
            <?php if (!empty($list) && count($list)) { ?>
              <?php foreach ($list as $key => $item) {
                $key = $key + 1;
                $num = $key > 9 ?  $key : '0' .  $key;
              ?>
                <div class="desktopContentSection">
                  <div class="desktopContentSection__wrap">
                    <span class="p-sm"><?= $num; ?></span>
                    <h2><?= $item['title'] ?></h2>
                    <p class="p-bg"><?= $item['description'] ?></p>
                  </div>
                </div>
            <?php }
            } ?>
          </div>
        </div>

        <div class="shimitest-gallery__right">
          <div class="shimitest-gallery__right-wrap">
            <div class="desktopPhotos">
              <?php foreach ($list as $key => $item) { ?>
                <div class="desktopPhoto ">
                  <?php echo wp_get_attachment_image($item['media']['id'], 'full', array('loading' => 'lazy',)); ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
