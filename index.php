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

  // /passwordRecovery?token=61a14865dc095
  try {
    // Router Exemple
      // $router->get('/routes', 'Controller#Function');
    $router->get('/', 'AppController#home');
    $router->get('/connection', 'AppController#connectionView'); // Connection view
    $router->get('/emailRecoveryView', 'AppController#emailRecoveryView'); // Form to send an email to recover the password
    $router->get('/passwordRecovery', 'AppController#passwordFormView'); // call the view for the new password form when a user is connected
    $router->get('/passwordRecovery-:token', 'AppController#passwordFormView')->with('token', '[0-9a-zA-Z]+'); // call the view for the new password form
    $router->post('/contactForm', 'AppController#contactForm'); // call the function to send the contact form mail
    $router->post('/sendEmailPasswordRecovery', 'AppController#sendEmailPasswordRecovery'); // call the function to send the mail for the recovery password
    $router->post('/passwordRecovery', 'AppController#passwordUpdate'); // call the function to update the password
    $router->get('/registration', 'UsersController#new'); // the new user form view
    $router->post('/registration', 'UsersController#create'); // call the function to create a new user

    // User
    $router->get('/logout', 'AppController#logout');
    $router->get('/user/show', 'UsersController#show');
    $router->get('/user/edit', 'UsersController#edit');
    $router->get('/admin/dashboard', 'UsersController#adminDashboard');
    $router->post('/user/edit', 'UsersController#update');
    $router->post('/login', 'AppController#login');
    
    // Post
    $router->get('/blog', 'PostsController#index');
    $router->get('/blog/post-:id', 'PostsController#show')->with('id', '[0-9]+');
    $router->get('/blog/post/new', 'PostsController#new');
    $router->get('/blog/post-:id/edit', 'PostsController#edit')->with('id', '[0-9]+');
    $router->post('/blog/post/new', 'PostsController#create');
    $router->post('/blog/post-:id/edit', 'PostsController#update')->with('id', '[0-9]+');
    $router->get('/blog/post-:id/delete', 'PostsController#destroy')->with('id', '[0-9]+');
    
    // Comment
    $router->get('/blog/post-:id/comment/new', 'CommentsController#new')->with('id', '[0-9]+');
    $router->post('/blog/post-:id/comment/new', 'CommentsController#create')->with('id', '[0-9]+');
    $router->get('/blog/admin/post-:postId/comment-:commentId/valid', 'CommentsController#validation')->with('postId', '[0-9]+','commentId', '[0-9]+');
    // $router->get('/blog/post-:postId/comment-:commentId/edit', 'CommentsController#edit')->with('postId', '[0-9]+','commentId', '[0-9]+');
    // $router->post('/blog/post-:postId/comment-:commentId/edit', 'CommentsController#update')->with('postId', '[0-9]+','commentId', '[0-9]+');
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