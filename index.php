<?php
  require('app/controllers/application_controller.php');
  // require('app/controllers/users_controller.php');
  // require('app/controllers/posts_controller.php');
  // require('app/controllers/comments_controller.php');


  if (isset($_GET['action'])) {
      // if ($_GET['action'] == 'listPosts') {
      //     // listPosts(); 
      // }
      // elseif ($_GET['action'] == 'post') {
      //     if (isset($_GET['id']) && $_GET['id'] > 0) {
      //         // post();
      //     }
      //     else {
      //         echo 'Erreur : aucun identifiant de billet envoyé';
      //     }
      // }
  }
  else {
      home();
  }