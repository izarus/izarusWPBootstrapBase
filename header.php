<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
  <!-- BARRA DE NAVEGACION RESPONSIVE -->
  <nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
          <span class="sr-only">Menu</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url() ?>"><?php bloginfo('name') ?></a>
      </div>

      <div class="collapse navbar-collapse" id="main-menu">
        <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'nav navbar-nav', 'menu_id' => 'main-menu' ) ); ?>

      </div>
    </div>
  </nav>
  <!-- FIN BARRA DE NAVEGACION -->
</header>