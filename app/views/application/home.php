<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
  <div>
    <h1>Mon premier blog en PhP!</h1>
    
    <p>Bonjour Je m'appelle Stéphane</p>
  </div>
<?php $content = ob_get_clean(); ?>

<?php require('app/views/layouts/template.php'); ?>