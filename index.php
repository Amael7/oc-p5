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
    
  $db = App\Manager\AppManager::dbConnect();
  $users = App\Manager\UserManager::getUsers();
  $user = App\Manager\UserManager::getUserById(1);
  
  dump($users);
  dump($user);

  try {
    // foreach ($users as $user) {
    //   dump($user);
    // }

  } catch (PDOException $e) {
    echo "Erreur!: " . $e->getMessage() . "<br/>";
    die();
  }
  

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