<?php
/**
 * Plantilla principal para página de inicio y página genérica
 */
 get_header() ?>


<div class="container">
  <section class="main-content">

    <!-- POSTS -->
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();

          // Plantilla de un post
          get_template_part( 'content', 'post' );

        endwhile;
          // Previous/next post navigation.
          //twentyfourteen_paging_nav();

        else :
          // Plantilla de "No hay posts"
          get_template_part( 'content', 'none' );

      endif;
    ?>
    <!-- FIN POSTS -->

  </section>
</div>


<?php get_footer() ?>