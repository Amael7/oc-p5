<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;
use App\Manager\UserManager;
use App\Core\Validation;

class AppController extends Controller {
  
  /**
   * function to render the home page view
   *
   * @return View
   */
  public function home()
  {
    $view = new View('Acceuil', 'application/home');
    $view->render();
  }

  // /**
  //  * function to send the contact form through the Post method
  //  *
  //  * @return 
  //  */
  // public function contact() {
    
  // }

  /**
   * function to render the connection View (where we can login or choose to create a new account)
   *
   * @return
   */
  public function connectionView() {
    $view = new View('Page de connexion', 'application/connectionView');
    $view->render();
  }

  /**
   * function to login the user
   *
   * @return
   */
  public function login() {
    $email = Validation::check($_POST['email']);
    $password = Validation::check($_POST['password']);
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    // $password = password_verify($password, $hash);
    
    $success_email = UserManager::checkUserByAttribute([':email' => "'$email'"], 'email');
    $success_password = UserManager::checkUserByAttribute([':password' => "'$hashPassword'"], 'password');
    
    if ($success_email && $success_password) {
      $user = UserManager::getUserByEmailAndPassword($email, $password, 'User');
      $_SESSION['user_auth'] = $user->getId();
      $_SESSION['flash']['success'] = 'Connexion réussi.';
      header("Location: /blog");
    } else {
      $_SESSION['flash']['danger'] = 'Aucun utilisateurs trouvé.';
      header("Location: /login");
    }
  }

  /**
   * function to logout the user
   *
   * @return
   */
  public function logout() {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    $_SESSION = array();
    session_destroy();

    header('Location: /connection');
  }

  /**
   * function to render the error 404 page view
   *
   * @return View
   */
  public function error404()
  {
    $view = new View('Page Introuvable', 'errors/404');
    $view->render();
  }

  /**
   * function to render the C.V page view
   *
   * @return View
   */
  public function cv() {
    $view = new View('Mon C.V', 'application/cv');
    $view->render();
  }
}