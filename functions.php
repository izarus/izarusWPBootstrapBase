<?php

/* Configuracion */

function izarus_theme_setup() {

  // THUMBNAILS
  add_theme_support( 'post-thumbnails' );
  // Principal
  set_post_thumbnail_size( 700, 300, true );
  // Adicionales
  add_image_size( 'full-width', 1200, 700, true );
  add_image_size( 'mid-width', 600, 400, true );
  add_image_size( 'mini', 200, 200, true );



  // MENUS
  register_nav_menus( array(
    'main-menu'   => 'Menú principal',
  ));


  // HTML5
  add_theme_support( 'html5', array(
    'gallery', 'caption'
  ));


  // TIPOS DE CONTENIDO
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
  ));

}
add_action( 'after_setup_theme', 'izarus_theme_setup' );




/* Carga de scripts y estilos */
function izarus_scripts() {
  wp_enqueue_style( 'base-style', get_stylesheet_uri() );
  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.5' );
  wp_enqueue_style( 'theme-style', get_template_directory_uri()  . '/css/theme.css', array('bootstrap') );

  wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.5' );

}
add_action( 'wp_enqueue_scripts', 'izarus_scripts' );






if ( ! function_exists( 'izarus_paging_nav' ) ) :
/**
 * Anterior y siguiente
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function izarus_paging_nav() {
  global $wp_query, $wp_rewrite;

  if ( $wp_query->max_num_pages < 2 ) {
    return;
  }

  $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
  $pagenum_link = html_entity_decode( get_pagenum_link() );
  $query_args   = array();
  $url_parts    = explode( '?', $pagenum_link );

  if ( isset( $url_parts[1] ) ) {
    wp_parse_str( $url_parts[1], $query_args );
  }

  $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
  $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

  $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
  $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

  $links = paginate_links( array(
    'base'     => $pagenum_link,
    'format'   => $format,
    'total'    => $wp_query->max_num_pages,
    'current'  => $paged,
    'mid_size' => 1,
    'add_args' => array_map( 'urlencode', $query_args ),
    'prev_text' => '&larr; Anterior',
    'next_text' => 'Siguiente &rarr;',
  ) );

  if ( $links ) :
  ?>
  <nav class="navigation paging-navigation" role="navigation">
    <h1 class="sr-only">Navegación</h1>
    <div class="pagination loop-pagination">
      <?php echo $links; ?>
    </div>
  </nav>
  <?php
  endif;
}
endif;
