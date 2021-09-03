<?php
//   require('app/controllers/AppController.php');
  // require('app/controllers/UserController.php');
  // require('app/controllers/PostController.php');
  // require('app/controllers/CommentController.php');

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (empty($_GET['url'])) {
    $_GET['url'] = '/';
  }

  $router = new App\Router\Router($_GET['url']);

  try {
    //   Router Exemple
    // $router->get('/routes', 'Controller#Function');
    // $router->post('/routes', 'Controller#Function');
    // Layout

    $router->get('/', 'AppController#home');

    // User


    // Post


    // Comment


    // Admin


    // 404
    $router->get('/404', 'ApplicationController#errorPage404');

    // Run Route
    $router->run();

  } catch (\Exception $e) {
    $errorMessage = $e-> getMessage();
    $_SESSION['errorMessage'] = $errorMessage;
  }