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
    <div class="header-navbar-container">
      <div class="title-header-nav">
        <h2>Blog PhP</h2>
      </div>
      <div class="navbar-menu-container">
        <ul id="list-navbar-menu">
          <li><a href="/">Accueil</a></li>
          <li><a href="/blog">Articles</a></li>
          <li><a href="/connection">Connexion</a></li>
          <li><a href="/registration">Inscription</a></li>
          <li><a href="/logout">Déconnexion</a></li>
        </ul>
      </div> 
    </div>

    <div id="main-container">
      <?= $content ?>
    </div>

    <div class="footer-container">
    <h3>Montoro Stéphane</h3>
    <div class="social-link-footer">
      <ul>
        <li><a a href="https://github.com/Amael7" target="blank"> <i class="fab fa-github"></i></a></li>
        <li><a href="https://www.linkedin.com/in/stephane-montoro/" target="blank"> <i class="fab fa-linkedin"></i></a></li>
        <li><a a href="https://twitter.com/MontoroStephane" target="blank"> <i class="fab fa-twitter"></i></a></li>
      </ul>
    </div>
      <p>Ce blog est édité par moi-même. Copyright © 2021-2021. Tous droits réservés.</p>
    </div>
  </body>
</html>