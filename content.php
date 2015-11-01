<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 <header class="entry-header">
    <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
    <div class="entry-meta">
      <span class="entry-date"><a href="<?php the_permalink() ?>" rel="bookmark"><time class="entry-date" datetime="<?php the_date('c') ?>"><?php echo esc_html( get_the_date() ) ?></time></a></span>
    </div>
  </header>

  <?php if ( is_search() || is_home() || is_front_page() ) : ?>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
  <?php else : ?>
  <div class="entry-content">
    <?php
      the_content();

      wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">Páginas: </span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
      ) );
    ?>
  </div>
  <?php endif; ?>

</article>