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
    
    $successEmail = UserManager::checkUserByAttribute($email, 'email');
    
    if ($successEmail) {
      $user = UserManager::getUserByEmail($email, 'User');
      $hashPassword = $user->getPassword();
      $successPassword = password_verify($password, $hashPassword);
      if ($successPassword) {
        $_SESSION['user_auth'] = $user->getId();
        $_SESSION['flash']['success'] = 'Connexion réussi.';
        header("Location: /blog");
      } else {
        $_SESSION['flash']['danger'] = 'Aucun utilisateurs trouvé.';
        header("Location: /connection");
      }
    } else {
      $_SESSION['flash']['danger'] = 'Aucun utilisateurs trouvé.';
      header("Location: /connection");
    }
  }

  /**
   * function to display the emailRecoveryView and get the email of the user
   *
   * @return
   */
  public function emailRecoveryView() {
      $view = new View('Page de récupération de mot de passe', 'application/emailRecoveryView');
      $view->render();
  }

  /**
   * function to send an email to the user for his password recovery
   *
   * @return
   */
  public function sendEmailPasswordRecovery() {
    $email = Validation::check($_POST['email']);
    $successEmail = UserManager::checkUserByAttribute($email, 'email');
    if ($successEmail) {
      $successMail = mail(
        $email, 
        "Renouvellement de mot de passe", 
        "Voici un mail de renouvellement de mot de passe pour le blog, veuillez cliquer sur le lien : <a href='localhost/passwordRecovery'>Créer un nouveau mot de passe</a>  "
      );
      if ($successMail) {
        $_SESSION['emailRecoverySend'] = true;
        $_SESSION['emailUser'] = $email;
        $_SESSION['flash']['success'] = 'Email envoyé.';
        header("Location: /emailRecoveryView");
      } else {
        $_SESSION['flash']['danger'] = "Echec de l'envoie d'email.";
        header("Location: /emailRecoveryView");
      }
    } else {
      $_SESSION['flash']['danger'] = 'Email non valide.';
      header("Location: /emailRecoveryView");
    }
  }

  /**
   * function to display the passwordFormView and get the email of the user
   *
   * @return
   */
  public function passwordFormView() {
    $view = new View('Modification du mot de passe', 'application/passwordFormView');
    $view->render();
  } 

  /**
   * function to update the password
   *
   * @return
   */
  public function passwordUpdate() {
    $user = (isset($_SESSION['user_auth'])) ? UserManager::getOne($_SESSION['user_auth'], 'User') : null ;
    $email = (isset($_SESSION['emailUser'])) ? Validation::check($_SESSION['emailUser']) : $user->getEmail();
    $successEmail = UserManager::checkUserByAttribute($email, 'email');
    if ($successEmail) {
      $password = Validation::check($_POST['password']);
      $passwordCheck = Validation::check($_POST['passwordCheck']);
      if ($password === $passwordCheck) {
        $user = ($user === null) ? UserManager::getUserByEmail($email, 'User') : $user ;
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $successPassword = UserManager::updateOneRow('User', $user->getId(), ['password' => $hashPassword]);
        if ($successPassword) {
          $_SESSION['emailRecoverySend'] = null;
          $_SESSION['emailUser'] = null;
          $_SESSION['flash']['success'] = 'Modification du mot de passe réussi.';
          header("Location: /blog");
        } else {
          $_SESSION['flash']['danger'] = 'Echec de la modification du mot de passe.';
          header("Location: /connection");
        }
      } 
    } else {
      $_SESSION['flash']['danger'] = 'Echec de la modification du mot de passe.';
      header("Location: /connection");
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