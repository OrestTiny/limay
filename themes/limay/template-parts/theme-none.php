<section class="upqode__not-found">
  <div class="container">
    <h1 class="page-title"><?php esc_html_e('Nothing Found', 'limay'); ?></h1>

    <div>
      <?php
      if (is_home() && current_user_can('publish_posts')) :

        printf(
          '<p>' . wp_kses(
            esc_html__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'limay'),
            array(
              'a' => array(
                'href' => array(),
              ),
            )
          ) . '</p>',
          esc_url(admin_url('post-new.php'))
        );

      elseif (is_search()) :
      ?>

        <p><?php esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'limay'); ?></p>
      <?php
        get_search_form();

      else :
      ?>

        <p><?php esc_html__('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'limay'); ?></p>
      <?php
        get_search_form();

      endif;
      ?>
    </div>
  </div>
</section>