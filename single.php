<?php get_header() ?>

<div class="container">
  <section class="main-content single-content">
    <?php
        while ( have_posts() ) : the_post();
          get_template_part( 'content', get_post_format() );
        endwhile;
      ?>
  </section>
</div>

<?php get_footer() ?>