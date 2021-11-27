<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;
use App\Models\User;
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
    $admin = false;
    if (isset($_SESSION['tokenAuth'])) {
      $admin = self::checkUserAdmin($_SESSION['tokenAuth']);
    }
    $view = new View('Acceuil', 'application/home');
    $view->render(compact('admin'));
  }

  /**
   * function to send an email through the contact form
   *
   * @return 
   */
  public function contactForm() {
    $visitorName = Validation::check($_POST["visitorName"]);
    $visitorEmail = Validation::check($_POST["visitorEmail"]);
    $mail_object = Validation::check($_POST["mailObject"]);
    $message = Validation::check($_POST["message"]);
    
    $emailBody = "<div>
                    <div>
                      <label><b>Objet du mail:<b></label>&nbsp;<span>" . $mail_object . "</span>
                    </div>
                    
                    <div>
                      <label><b>Nom du visiteur:<b></label>&nbsp;<span>" . $visitorName . "</span>
                    </div>
                    
                    <div>
                      <label><b>Email du visiteur:<b></label>&nbsp;<span>" . $visitorEmail . "</span>
                    </div>
                    
                    <div>
                      <label><b>Message du visiteur:<b></label>
                      <div>" . $message . "</div>
                    </div>
                  </div>";

    $headers = 'MIME-Version: 1.0' . "\r\n"
              . 'Content-type: text/html; charset=utf-8' . "\r\n"
              . 'From: ' . $visitorEmail . "\r\n";

    $successEmail = mail("stephane.montoro@hotmail.com", $mail_object, $emailBody, $headers);

    if ($successEmail) {
      $_SESSION['contactFormSend'] = true;
      $_SESSION['flash']['success'] = 'Email envoyé.';
      header("Location: /");
    } else {
      $_SESSION['flash']['danger'] = "Echec de l'envoie d'email.";
      header("Location: /");
    } 
  } 

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
        $token = $user->setTokenAuth();
        UserManager::updateOneTokenRow('User', $user->getId(), ['token_auth' => $token]);
        $user = UserManager::getUserByTokenAuth($token, 'User');
        $_SESSION['tokenAuth'] = $user->getTokenAuth();
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
      $user = UserManager::getUserByEmail($email, 'User');
      $token = $user->setTokenEmailRecuperation();
      UserManager::updateOneTokenRow('User', $user->getId(), ['token_email_recuperation' => $token]);
      $user = UserManager::getUserByTokenEmail($token, 'User');
      
      $emailObject = "Renouvellement de mot de passe";
      $emailBody = "<div>
                      <div>
                        <p>Bonjour" . $user->getFullname() . ", </p>&nbsp;
                      </div>

                      <div>
                        <p><b>Vous avez effectué une demande de mot de passe oublié.<b></p>&nbsp;
                      </div>
                      
                      <div>
                        <p><b>Voici le lien de renouvellement de mot de passe :<b></p>&nbsp;
                      </div>
                      
                      <div>
                        <a href='localhost/passwordRecovery?token=" . $user->getTokenEmailRecuperation() . "'>Créer un nouveau mot de passe</a>
                      </div>
                    </div>";
      
      $headers = 'MIME-Version: 1.0' . "\r\n"
      . 'Content-type: text/html; charset=utf-8' . "\r\n"
      . 'From: stephane.montoro@hotmail.com' . "\r\n";
      
      $successMail = mail($email, $emailObject, $emailBody, $headers);
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
  public function passwordFormView($token) {
    $admin = false;
    $user = UserManager::getUserByToken($token, 'token_email_recuperation', 'User');
    if (isset($_SESSION['tokenAuth'])) {
      $admin = self::checkUserAdmin($_SESSION['tokenAuth']);
    }
    $view = new View('Modification du mot de passe', 'application/passwordFormView');
    $view->render(compact('user', 'admin'));
  } 

  /**
   * function to update the password
   *
   * @return
   */
  public function passwordUpdate() {
    $user = UserManager::getUserByTokenAuth($_SESSION['tokenAuth'], 'User');
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
  public function error404() {
    $view = new View('Page Introuvable', 'errors/404');
    $view->render();
  }

  /**
   * Check if the user is an admin with the token_admin
   *
   * @return bool
   */
  public static function checkUserAdmin($tokenAuth) {
    $user = UserManager::getUserByTokenAuth($tokenAuth ,'User');
    return $user->getAdmin();
  }
}