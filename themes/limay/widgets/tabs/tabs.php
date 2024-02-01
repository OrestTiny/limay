<?php

namespace Elementor;

class Limay_Tabs extends Widget_Base
{

  public function get_name()
  {
    return 'limay-tabs';
  }

  public function get_title()
  {
    return 'Limay Tabs';
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
    wp_enqueue_style('limay-tabs', LIMAY_T_URI . '/widgets/tabs/assets/css/tabs.min.css');
    wp_register_script(
      'limay-tabs',
      LIMAY_T_URI . '/widgets/tabs/assets/js/tabs.min.js'
    );
  }

  public function get_script_depends()
  {
    return ['limay-tabs'];
  }

  public function get_style_depends()
  {
    return ['limay-tabs'];
  }

  protected function _register_controls()
  {

    $this->start_controls_section(
      'section_content',
      [
        'label' => esc_html__('Content', 'limay'),
      ]
    );

    $tabs = new Repeater();

    $tabs->add_control(
      'name',
      [
        'label' => esc_html__('Name', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Default Name', 'limay'),
        'placeholder' => esc_html__('Type your name here', 'limay'),
        'label_block' => true,
      ]
    );

    $tabs->add_control(
      'title',
      [
        'label' => esc_html__('Title', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Default title', 'limay'),
        'placeholder' => esc_html__('Type your title here', 'limay'),
        'label_block' => true,
      ]
    );

    $tabs->add_control(
      'subtitle',
      [
        'label' => esc_html__('Subtitle', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => esc_html__('Default subtitle', 'limay'),
        'placeholder' => esc_html__('Type your subtitle here', 'limay'),
        'label_block' => true,
      ]
    );

    $tabs->add_control(
      'description',
      [
        'label' => esc_html__('Description', 'limay'),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => esc_html__('Default Description', 'limay'),
        'placeholder' => esc_html__('Type your description here', 'limay'),
        'label_block' => true,
      ]
    );

    $tabs->add_control(
      'btn_name',
      [
        'label'       => esc_html__('Button Text', 'limay'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Button', 'limay'),
        'label_block' => true,
      ]
    );

    $tabs->add_control(
      'btn_url',
      [
        'label'       => esc_html__('Button URL', 'limay'),
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'limay'),
        'default'     => [
          'url' => '',
        ]
      ]
    );

    $this->add_control(
      'tabs',
      [
        'label'  => esc_html__('Repeater Slides', 'limay'),
        'type'   => \Elementor\Controls_Manager::REPEATER,
        'fields' => $tabs->get_controls(),
      ]
    );



    $this->end_controls_section();
  }

  protected function render()
  {

    $settings = $this->get_settings_for_display();

    $no_title = !empty($item['title']) ? "" : 'no-title';

?>
    <div class="limay-tabs">
      <ul class="limay-tab-links">
        <?php foreach ($settings['tabs'] as $key => $item) {
          $active = $key == 0 ? 'class="active"' : '';
          $item_id = '#limay-tab' . $key + 1;
        ?>
          <li <?php echo $active; ?>>
            <h5 class="m-0" data-item="<?php echo $item_id; ?>">
              <?php echo $item['name'] ?>
              <i class="icon-arrow-right"></i>
            </h5>
          </li>
        <?php } ?>
      </ul>

      <div class="limay-tab-content">
        <?php foreach ($settings['tabs'] as $key => $item) {
          $active = $key == 0 ? 'active' : '';
          $item_id = 'limay-tab' . $key + 1;
        ?>
          <div id="<?php echo $item_id; ?>" class="<?php echo $no_title; ?> limay-tab <?php echo $active; ?>">
            <?php if (!empty($item['title'])) { ?>
              <h4><?php echo $item['title']; ?></h4>
            <?php  } ?>

            <?php if (!empty($item['subtitle'])) { ?>
              <p class="p-bg"><?php echo $item['subtitle']; ?></p>
            <?php } ?>


            <div class="limay-tab__desc inside-sec"><?php echo $item['description']; ?></div>


            <?php if (!empty($item['btn_url']['url']) && !empty($item['btn_name'])) { ?>
              <a class="btn btn-pr" <?php isLink($item['btn_url']); ?>><?php echo $item['btn_name']; ?></a>
            <?php } ?>

          </div>
        <?php } ?>
      </div>
    </div>
<?php
  }
}
