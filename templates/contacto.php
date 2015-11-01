<?php
/**
 * Template Name: Contacto
 */

if (isset($_GET['ok'])) {
  $success = 'El mensaje se ha enviado correctamente. Será respondido a la brevedad.';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $data = $_REQUEST;
  $error = array();

  // VALIDACIONES
  if (empty($data['nombre'])) $error['nombre'] = 'El nombre es obligatorio.';
  if (empty($data['email'])) $error['email'] = 'El correo electrónico es obligatorio.';
  if (empty($data['mensaje'])) $error['mensaje'] = 'El mensaje es obligatorio.';
  if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $error['email'] = 'El correo electrónico no es válido.';

  $date = date('d-m-Y H:i:s');
  $web = get_bloginfo('name');
$mensaje = <<<EOF
Se ha recibido un mensaje desde el sitio web "$web"

De: $data[nombre]
Email: $data[email]
Teléfono: $data[telefono]
Mensaje:

$data[mensaje]

$date
EOF;

  if (empty($error)) {
    if (wp_mail(
      get_bloginfo('admin_email'),
      '[ Mensaje de Contacto Web ]',
      $mensaje,
      array(
        'From: '.$web.' <'.$data['email'].'>',
        'Reply-To: '.$data['email'],
        )
      )) {
      header('Location: '.$_SERVER['PHP_SELF'].'?ok');
      die;
    } else {
      $error['global'] = 'Error en el servidor al intentar enviar el email.';
    }
  }
}

get_header() ?>

<div class="container">
  <section class="main-content page-content page-content-contacto">
  <?php while ( have_posts() ) : the_post(); ?>
    <header class="entry-header">
    <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
    <?php the_content() ?>
  <?php endwhile; ?>
    <hr>
    <form method="post">
      <h2>Formulario de Contacto</h2>
      <?php if (isset($error) && !empty($error)): ?>
        <div class="alert alert-danger">
          <p>Se ha producido un error y no se ha enviado el mensaje.</p>
          <?php if (isset($error['global']) && !empty($error['global'])): ?>
            <p><?php echo $error['global'] ?></p>
          <?php endif ?>
        </div>
      <?php endif ?>
      <?php if (isset($success) && !empty($success)): ?>
        <div class="alert alert-success">
          <p><?php echo $success ?></p>
        </div>
      <?php endif; ?>
      <div class="form-group <?php echo (isset($error['nombre']))?'has-error':'' ?>">
        <label class="control-label" for="nombre">Nombre:</label>
        <input class="form-control" name="nombre" id="nombre" value="<?php echo (isset($data['nombre']))?$data['nombre']:'' ?>" placeholder="Nombre y Apellidos" />
        <div class="help-block">
          <?php if(isset($error['nombre'])): ?>
            <p>
              <i class="glyphicon glyphicon-exclamation-sign"></i> <?php echo $error['nombre'] ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
      <div class="form-group <?php echo (isset($error['email']))?'has-error':'' ?>">
        <label class="control-label" for="email">Correo Electrónico:</label>
        <input class="form-control" name="email" id="email" value="<?php echo (isset($data['email']))?$data['email']:'' ?>" placeholder="email@email.com" />
        <div class="help-block">
          <?php if(isset($error['email'])): ?>
            <p>
              <i class="glyphicon glyphicon-exclamation-sign"></i> <?php echo $error['email'] ?>
            </p>
          <?php endif; ?>
          <p><i class="glyphicon glyphicon-info-sign"></i> Será contactado a esta dirección.</p>
        </div>
      </div>
      <div class="form-group <?php echo (isset($error['telefono']))?'has-error':'' ?>">
        <label class="control-label" for="telefono">Teléfono:</label>
        <input class="form-control" name="telefono" id="telefono" value="<?php echo (isset($data['telefono']))?$data['telefono']:'' ?>" placeholder="+5699999999" />
        <div class="help-block">
          <?php if(isset($error['telefono'])): ?>
            <p>
              <i class="glyphicon glyphicon-exclamation-sign"></i> <?php echo $error['telefono'] ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
      <div class="form-group <?php echo (isset($error['mensaje']))?'has-error':'' ?>">
        <label class="control-label" for="mensaje">Mensaje:</label>
        <textarea class="form-control" name="mensaje" id="mensaje"><?php echo (isset($data['mensaje']))?$data['mensaje']:'' ?></textarea>
        <div class="help-block">
          <?php if(isset($error['mensaje'])): ?>
            <p>
              <i class="glyphicon glyphicon-exclamation-sign"></i> <?php echo $error['mensaje'] ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
      <div class="form-group">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> Enviar mensaje</button>
      </div>
    </form>
  </header>
  </section>
</div>



<?php get_footer() ?>