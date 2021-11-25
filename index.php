<?php
  require 'vendor/autoload.php';
  
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  
  define('ROOT', dirname(__DIR__));
  
  /**
   * Load Dotenv to use .env on all the app. **** e.g: $_ENV[DB_HOST]
   */
  \Dotenv\Dotenv::createImmutable(__DIR__)->load();

  $router = new App\Router\Router($_SERVER['REQUEST_URI']);

  try {
    // Router Exemple
      // $router->get('/routes', 'Controller#Function');
    // Layout
    $router->get('/', 'AppController#home');
    $router->get('/cv', 'AppController#cv');
    $router->post('/contactForm', 'AppController#contactForm');
    $router->get('/connection', 'AppController#connectionView');
    $router->get('/emailRecoveryView', 'AppController#emailRecoveryView');
    $router->post('/sendEmailPasswordRecovery', 'AppController#sendEmailPasswordRecovery');
    $router->get('/passwordRecovery', 'AppController#passwordFormView');
    $router->post('/passwordRecovery', 'AppController#passwordUpdate');
    $router->post('/login', 'AppController#login');
    $router->get('/logout', 'AppController#logout');
    // User
    $router->get('/registration', 'UsersController#new');
    $router->post('/registration', 'UsersController#create');
    $router->get('/user/show', 'UsersController#show');
    $router->get('/user/edit', 'UsersController#edit');
    $router->post('/user/edit', 'UsersController#update');
    // Admin
    $router->get('/admin/dashboard', 'UsersController#adminDashboard');
    $router->get('/blog/admin/post-:postId/comment-:commentId/valid', 'CommentsController#validation')->with('postId', '[0-9]+','commentId', '[0-9]+');
    // Post
    $router->get('/blog', 'PostsController#index');
    $router->get('/blog/post-:id', 'PostsController#show')->with('id', '[0-9]+');
    $router->get('/blog/post/new', 'PostsController#new');
    $router->post('/blog/post/new', 'PostsController#create');
    $router->get('/blog/post-:id/edit', 'PostsController#edit')->with('id', '[0-9]+');
    $router->post('/blog/post-:id/edit', 'PostsController#update')->with('id', '[0-9]+');
    $router->get('/blog/post-:id/delete', 'PostsController#destroy')->with('id', '[0-9]+');
    // Comment
    $router->get('/blog/post-:id/comment/new', 'CommentsController#new')->with('id', '[0-9]+');
    $router->post('/blog/post-:id/comment/new', 'CommentsController#create')->with('id', '[0-9]+');
    $router->get('/blog/post-:postId/comment-:commentId/edit', 'CommentsController#edit')->with('postId', '[0-9]+','commentId', '[0-9]+');
    $router->post('/blog/post-:postId/comment-:commentId/edit', 'CommentsController#update')->with('postId', '[0-9]+','commentId', '[0-9]+');
    $router->get('/blog/post-:postId/comment-:commentId/delete', 'CommentsController#destroy')->with('postId', '[0-9]+','commentId', '[0-9]+');
    // 404
    $router->get('/404', 'AppController#error404'); // 
    // Run Route
    $router->run();

  } catch (\Exception $e) {
    $errorMessage = $e-> getMessage();
    $_SESSION['errorMessage'] = $errorMessage;
    header('HTTP/1.1 404 Not Found');
    header('Location: /404');
  }