<?php

/**
 * Category Template
 */

get_header();


$term = get_queried_object();
$term_name = $term->taxonomy;

$title = is_category() ? esc_html__('Category: ', 'limay') . $term->name : $title;
$title = is_tag() ? esc_html__('Tag: ', 'limay') . $term->name : $title;


if (have_posts()) : ?>
  <section class="limay-blog">

    <?php if (!empty($title)) { ?>
      <div class="limay-blog__heading">
        <div class="container">
          <h1><?php echo esc_html__($title, 'limay'); ?></h1>
        </div>
      </div>
    <?php } ?>

    <div class="limay-blog__main">
      <div class="container">
        <div class="limay-blog__main-wrap">
          <?php while (have_posts()) : the_post();

            upqode_post_card();

          endwhile;
          wp_reset_postdata(); ?>
        </div>
        <?php upqode_custom_pagination(); ?>
      </div>
    </div>
  </section>

<?php else :
  get_template_part('template-parts/theme', 'none');
endif;

get_footer();
