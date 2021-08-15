<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="app/assets/stylesheets/style.css" rel="stylesheet" /> 
  </head>
  <body>
    <div class="header_navbar">
      <?php
        // we require the header navbar here 
        require('app/views/partials/header_navbar.php'); 
      ?>
    </div>

    <?= $content ?>

    <div class="footer">
      <?php
        // we require the footer here 
        require('app/views/partials/footer.php'); 
      ?>
    </div>
  </body>
</html>