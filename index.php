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
    $router->post('/contact', 'AppController#contact');
    // User
    $router->get('/connection', 'UserController#connectionForm');
    $router->get('/registration', 'UserController#registrationForm');
    $router->post('/registration', 'UserController#registration');
    $router->post('/login', 'UserController#login');
    $router->post('/logout', 'UserController#logout');
    // Admin
    $router->get('/blog/admin/Dashboard', 'UserController#AdminDashboard');    
    $router->get('/blog/admin/Post-:id', 'UserController#postShow')->with('id', '[0-9]+');
    $router->get('/blog/admin/comments', 'CommentController#index');    
    $router->post('/blog/admin/comments-:id/valide', 'CommentController#valide')->with('id', '[0-9]+');    
    $router->post('/blog/admin/comments-:id/delete', 'CommentController#destroy')->with('id', '[0-9]+');       
    // Post
    $router->get('/blog', 'PostController#index');
    $router->get('/blog/post-:id', 'PostController#show')->with('id', '[0-9]+');
    $router->get('/blog/post/new', 'PostController#new');
    $router->post('/blog/post/new', 'PostController#create');
    $router->get('/blog/post-:id/edit', 'PostController#edit')->with('id', '[0-9]+');
    $router->post('/blog/post-:id/edit', 'PostController#update')->with('id', '[0-9]+');
    $router->post('/blog/post-:id/delete', 'PostController#destroy')->with('id', '[0-9]+');
    // Comment
    $router->get('/blog/comment/new', 'CommentController#new');
    $router->post('/blog/comment/new', 'CommentController#create');
    $router->get('/blog/comment-:id/edit', 'CommentController#edit')->with('id', '[0-9]+');
    $router->post('/blog/comment-:id/edit', 'CommentController#update')->with('id', '[0-9]+');
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