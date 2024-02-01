<?php

/**
 * Single post
 */

get_header();

while (have_posts()) : the_post();


?>
  <section class="limay-single" <?php post_class(); ?>>
    <div class="container">
      <div class="limay-single__wrap">

        <?php the_title('<h1 class="limay-single__title">', '</h1>'); ?>

        <?php if (has_post_thumbnail()) { ?>
          <div class="limay-single__banner">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php } ?>

        <div class="limay-single__categories">
          <?php the_category(' '); ?>
        </div>

        <div class="limay-single__author">
          <?php upqode_posted_by_author() ?>
        </div>

        <div class="limay-single__date">
          <?php echo get_the_date(); ?>
        </div>

        <div class="limay-single__content">
          <?php the_content(); ?>
        </div>

        <?php
        the_tags(
          '<div class="limay-single__tags">',
          ' ',
          '</div>'
        ); ?>


      </div>
    </div>
  </section>


<?php endwhile;

wp_reset_postdata();

get_footer();
