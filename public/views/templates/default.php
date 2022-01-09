<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="/public/assets/stylesheets/style.css" rel="stylesheet" /> 
  </head>
  <body>
    <div id="main-wrapper">
      <!-- Header Navbar Start -->
      <div class="header-navbar-container">
        <div class="title-header-nav">
          <h1>Blog PhP</h1>
        </div>
        <div class="navbar-menu-container">
          <ul id="list-navbar-menu">
            <li><a href="/">Accueil</a></li>
            <li><a href="/blog">Articles</a></li>
            <?php if (isset($_SESSION['tokenAuth'])): ?>
              <?php if (isset($admin) && $admin): ?>
                <li><a href="/admin/dashboard">Dashboard</a></li>
              <?php endif; ?>
              <li><a href=<?= '/user/show' ?> >Mon profil</a></li>
              <li><a href="/logout">Déconnexion</a></li>
              <?php else: ?>
                <li><a href="/connection">Connexion</a></li>
                <li><a href="/registration">Inscription</a></li>
            <?php endif; ?>
          </ul>
        </div> 
      </div>
      <!-- Header Navbar End -->

      <div id="main-body-container">
        <?= $content ?>
      </div>
      <!-- Footer Navbar Start -->
      <footer>
        <div class="footer-container">
          <h3>Montoro Stéphane</h3>
          <p>Ce blog est édité par moi-même. Copyright © 2021-2021. Tous droits réservés.</p>
        </div>
      </footer>
      <!-- Footer Navbar Start -->
    </div>
  </body>

</html>