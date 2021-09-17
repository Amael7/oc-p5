<?php
  require 'vendor/autoload.php';

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (empty($_GET['url'])) {
    $_GET['url'] = '/';
  }
  
  /**
   * Load Dotenv to use .env $_ENV[DB_HOST]
   */
  \Dotenv\Dotenv::createImmutable(__DIR__)->load();
    
  // $db = App\Manager\AppManager::dbConnect();
  $users = App\Manager\UserManager::getAll("User");
  $user = App\Manager\UserManager::getOne(1, "User");
  $posts = App\Manager\PostManager::getAll("Post");
  $post = App\Manager\PostManager::getOne(1, "Post");
  $postAuthor = App\Manager\PostManager::getPostByAuthor(1, "Post");
  $comments = App\Manager\CommentManager::getAll("Comment");
  $comment = App\Manager\CommentManager::getOne(1, "Comment");
  
  dump($users);
  dump($user);
  dump($posts);
  dump($post);
  dump($postAuthor);
  dump($comments);
  dump($comment);

  $router = new App\Router\Router($_GET['url']);

  try {
    // Router Exemple
    // $router->get('/routes', 'Controller#Function');
    // $router->post('/routes', 'Controller#Function');
    // Layout
    $router->get('/', 'AppController#home');

    // User


    // Post


    // Comment


    // Admin


    // 404
    // $router->get('/404', 'AppController#errorPage404');

    // Run Route
    $router->run();

  } catch (\Exception $e) {
    $errorMessage = $e-> getMessage();
    $_SESSION['errorMessage'] = $errorMessage;
  }