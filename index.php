<?php
  require 'vendor/autoload.php';

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (empty($_GET['url'])) {
    $_GET['url'] = '/';
  }
  
  /**
   * Load Dotenv to use .env on all the app. **** e.g: $_ENV[DB_HOST]
   */
  \Dotenv\Dotenv::createImmutable(__DIR__)->load();

  $router = new App\Router\Router($_GET['url']);

  try {
    // Router Exemple
      // $router->get('/routes', 'Controller#Function');
    // Layout
    $router->get('/', 'AppController#home');
    $router->get('/blog/contact', 'AppController#contactForm');
    $router->post('/blog/contact/create', 'AppController#contact'); // à voir si je garde le '/create' dans l'url
    // User
    $router->get('/connection', 'UserController#connectionForm');
    $router->get('/registration', 'UserController#registrationForm');
    $router->post('/registration', 'UserController#registration'); // #create ??
    $router->post('/login', 'UserController#login');
    $router->post('/logout', 'UserController#logout');
    // Admin
    $router->get('/blog/user-:id/admin/Dashboard', 'UserController#AdminDashboard');    
    $router->get('/blog/user-:id/admin/Post-:id', 'PostController#show'); // need id object , lui passer avec (->with('id', '[0-9]+'))  
    $router->get('/blog/user-:id/admin/comments', 'CommentController#index');    
    $router->post('/blog/user-:id/admin/comments-:id/valide', 'CommentController#valide');    
    $router->post('/blog/user-:id/admin/comments-:id/delete', 'CommentController#destroy');       
    // Post
    $router->get('/blog', 'PostController#index');
    $router->get('/blog/post-:id', 'PostController#show');
    $router->get('/blog/user-:id/post/new', 'PostController#new');
    $router->post('/blog/user-:id/post/create', 'PostController#create');
    $router->get('/blog/user-:id/post-:id/edit', 'PostController#edit');
    $router->post('/blog/user-:id/post-:id/update', 'PostController#update');
    $router->post('/blog/user-:id/post-:id/delete', 'PostController#destroy');
    // Comment
    $router->get('/blog/user-:id/comment/new', 'CommentController#new');
    $router->post('/blog/user-:id/comment/add', 'CommentController#create');
    $router->get('/blog/user-:id/comment:id/edit', 'CommentController#edit');
    $router->post('/blog/user-:id/comment:id/update', 'CommentController#update');
    // 404
    $router->get('/404', 'AppController#error404');
    // Run Route
    $router->run();

  } catch (\Exception $e) {
    $errorMessage = $e-> getMessage();
    $_SESSION['errorMessage'] = $errorMessage;
    header('HTTP/1.1 404 Not Found'); // à approfondir 
    header('Location: /404'); // à approfondir 
  }