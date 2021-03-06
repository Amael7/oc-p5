<?php

namespace App\Controllers;

use App\Manager\UserManager;
use App\Manager\PostManager;
use App\Models\User;
use App\Core\Validation;
use App\Core\View;

class UsersController extends AppController {

  public function new() {
    $view = new View('Création de compte', 'users/new');
    $view->render();
  }
  
  public function create() {
    $firstName = Validation::check($_POST['firstName']);
    $lastName = Validation::check($_POST['lastName']);
    $email = Validation::check($_POST['email']);
    $password = Validation::check($_POST['password']);
    $passwordCheck = Validation::check($_POST['passwordCheck']);

    if ($password === $passwordCheck) {
      $hashPassword = password_hash($password, PASSWORD_DEFAULT);

      $attributes = [ ':email' => $email,
                      ':password' => $hashPassword,
                      ':first_name' => $firstName,
                      ':last_name' => $lastName,
                      ':description' => '',
                    ];
      $success = UserManager::addOneRow('User', '(email, password, first_name, last_name, description)', '(:email, :password, :first_name, :last_name, :description)', $attributes);
    } else {
      $success = false;
    }

    if ($success) {
      $_SESSION['flash']['success'] = 'Création de compte validé.';
      header('Location: /connection');
    } else {
      $_SESSION['flash']['danger'] = "Le formulaire d'inscription n'est pas valide.";
      header('Location: /registration');
    }
  }

  public function show() {
    if (isset($_SESSION['tokenAuth'])) {
      $admin = self::checkUserAdmin($_SESSION['tokenAuth']);
      $user = UserManager::getUserByTokenAuth($_SESSION['tokenAuth'], 'User');
      $view = new View('Mon profil', 'users/show');
      $view->render(compact('user', 'admin'));
    }
  }
  
  public function edit() {
    if (isset($_SESSION['tokenAuth'])) {
      $admin = self::checkUserAdmin($_SESSION['tokenAuth']);
      $user = UserManager::getUserByTokenAuth($_SESSION['tokenAuth'], 'User');

      $_POST['firstName'] =  $user->getFirstName();
      $_POST['lastName'] = $user->getLastName();
      $_POST['email'] = $user->getEmail();
      $_POST['description'] = $user->getDescription();

      $view = new View('Modification de compte', 'users/edit');
      $view->render(compact('user', 'admin'));
    } 
  } 

  public function update() {
    if (isset($_SESSION['tokenAuth'])) {
      $user = UserManager::getUserByTokenAuth($_SESSION['tokenAuth'], 'User');

      $email = Validation::check($_POST['email']);

      $firstName = Validation::check($_POST['firstName']);
      $lastName = Validation::check($_POST['lastName']);
      $description = Validation::check($_POST['description']);
      
      $attributes = [ 'email' => $email,
                      'first_name' => $firstName,
                      'last_name' => $lastName,
                      'description' => $description,
                    ];
      $success = UserManager::updateOneRow('User', $user->getId(), $attributes);
        
      if ($success) {
        $_SESSION['flash']['success'] = 'Le compte à bien été modifié.';
        header("Location: /user/show");
      } else {
        $_SESSION['flash']['danger'] = "Un ou plusieurs des champs n'est pas valide.";
        header("Location: /user/edit");
      }
    }
  }

  public function adminDashboard() {
    if (isset($_SESSION['tokenAuth'])) {
      $admin = self::checkUserAdmin($_SESSION['tokenAuth']);
      $user = UserManager::getUserByTokenAuth($_SESSION['tokenAuth'], 'User');
      $posts = PostManager::getAll("Post");
      $view = new View('Mon Dashboard', 'users/adminDashboard');
      $view->render(compact('user', 'admin', 'posts'));
    } 
  }
}