<?php
defined('ABSPATH') || exit;

function ai_register_main_options_metabox()
{

  $main_options = new_cmb2_box(array(
    'id'           => 'limay_main_options',
    'object_types' => array('options-page'),
    'tab_group'    => 'limay_options_tab',
    'menu_title'   => esc_html__('Main Options', 'limay'),
    'title'        => esc_html__('Main Options', 'limay'),
    'tab_title'    => esc_html__('Main Options', 'limay'),
    'option_key'      => 'limay_main_options', // The option key and admin menu page slug.
    'position'        => 2, // Menu position. Only applicable if 'parent_slug' is left empty.
  ));

  $main_options->add_field(array(
    'name' => '<h1>Global<h1>',
    'type' => 'title',
    'id'   => 'limay_global_id'
  ));

  $social_group_id = $main_options->add_field(array(
    'name' => 'Social Links',
    'id'          => 'limay_social_group',
    'type'        => 'group',
    'repeatable'  => true,
    'options'     => array(
      'group_title'   => 'Link #{#}',
      'add_button'    => 'Add Another Post',
      'remove_button' => 'Remove Post',
      'closed'        => true,  // Repeater fields closed by default - neat & compact.
      'sortable'      => true,  // Allow changing the order of repeated groups.
    ),
  ));

  $main_options->add_group_field($social_group_id, array(
    'name' => 'Social Name',
    'id'   => 'limay_social_group_name',
    'type' => 'text',
  ));

  $main_options->add_group_field($social_group_id, array(
    'name'             => 'Social Icon',
    'desc'             => 'Select an option',
    'id'               => 'limay_social_group_icon',
    'type'             => 'select',
    'show_option_none' => true,
    'default'          => 'custom',
    'options'          => array(
      'icon-twitter'      => __('Twitter', 'limay'),
      'icon-facebook'     => __('Facebook', 'limay'),
      'icon-linkedin'     => __('Linkedin', 'limay'),
      'icon-instagram'    => __('Instagram', 'limay'),
    ),
  ));

  $main_options->add_group_field($social_group_id, array(
    'name' => 'Social URL',
    'id'   => 'limay_social_group_link',
    'type' => 'text_url',
  ));


  // -------------

  $main_options->add_field(array(
    'name' => '<h1>Megamenu<h1>',
    'type' => 'title',
    'id'   => 'limay_megamenu_id'
  ));

  $main_options->add_field(array(
    'name' => "Logo Image",
    'id'   => "limay_megamenu",
    'type' => 'file',
  ));

  $main_options->add_field(array(
    'name' => "Button Name",
    'id'   => "limay_megamenu_btn_name",
    'type' => 'text',
  ));

  $main_options->add_field(array(
    'name' => "Button Link",
    'id'   => "limay_megamenu_btn_link",
    'type' => 'text_url',
  ));

  // $main_options->add_field(array(
  //   'name' => "Embed Code",
  //   'id'   => "limay_header_embed_code",
  //   'type' => 'textarea_code',
  // ));

  // ----------------------------------

  // $main_options->add_field(array(
  //   'name' => '<h1>Footer<h1>',
  //   'type' => 'title',
  //   'id'   => 'limay_footer'
  // ));

  // $main_options->add_field(array(
  //   'name' => "Logo Image",
  //   'id'   => "limay_footer_logo",
  //   'type' => 'file',
  // ));

  // $main_options->add_field(array(
  //   'name' => "Title",
  //   'id'   => "limay_footer_title",
  //   'type' => 'text',
  // ));

  // $main_options->add_field(array(
  //   'name' => "First Button Name",
  //   'id'   => "limay_footer_first_button_name",
  //   'type' => 'text',
  // ));

  // $main_options->add_field(array(
  //   'name' => "First Button Link",
  //   'id'   => "limay_footer_first_button_link",
  //   'type' => 'text_url',
  // ));

  // $main_options->add_field(array(
  //   'name' => "Second Button Name",
  //   'id'   => "limay_footer_second_button_name",
  //   'type' => 'text',
  // ));

  // $main_options->add_field(array(
  //   'name' => "Second Button Link",
  //   'id'   => "limay_footer_second_button_link",
  //   'type' => 'text_url',
  // ));

  // $main_options->add_field(array(
  //   'name' => "Copyright",
  //   'id'   => "limay_footer_copyright",
  //   'type' => 'textarea',
  // ));
}

add_action('cmb2_admin_init', 'ai_register_main_options_metabox');
