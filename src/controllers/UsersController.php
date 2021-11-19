<?php

namespace App\Controllers;

use App\Manager\UserManager;
use App\Models\User;
use App\Core\Validation;
use App\Core\View;

class UsersController extends AppController {

  public function new() {
    $view = new View('Création de compte', 'users/new');
    $view->render();
  }
  
  public function create() {
    $email = Validation::check($_POST['email']);
    $password = Validation::check($_POST['password']);
    $passwordCheck = Validation::check($_POST['passwordCheck']);

    if ($password === $passwordCheck) {
      $hashPassword = password_hash($password, PASSWORD_DEFAULT);

      $attributes = [ ':email' => $email,
                      ':password' => $hashPassword,
                      ':first_name' => '',
                      ':last_name' => '',
                      ':description' => '',
                    ];
      $success = UserManager::addOneRow('User', '(email, password, first_name, last_name, description)', '(:email, :password, :first_name, :last_name, :description)', $attributes);
    } else {
      $success = false;
    }

    if ($success === true) {
      $_SESSION['flash']['success'] = 'Création de compte validé.';
      header('Location: /connection');
    } else {
      $_SESSION['flash']['danger'] = "Le formulaire d'inscription n'est pas valide.";
      header('Location: /registration');
    }
  }

  public function show($id) {
    $user = UserManager::getOne($id, "User");

    $view = new View('Mon profil', 'users/show');
    $view->render(compact('user'));
  }
  
  public function edit($id) {
    $user = UserManager::getOne($id, "User");

    $_POST['firstName'] =  $user->getFirstName();
    $_POST['lastName'] = $user->getLastName();
    $_POST['email'] = $user->getEmail();
    $_POST['description'] = $user->getDescription();

    $view = new View('Modification de compte', 'users/edit');
    $view->render(compact('user'));
  }

  public function update($id) {
    $user = UserManager::getOne($id, "User");
    $userId = $user->getId();

    $email = Validation::check($_POST['email']);
    // $password = Validation::check($_POST['password']);
    // $passwordCheck = Validation::check($_POST['passwordCheck']);

    $firstName = Validation::check($_POST['firstName']);
    $lastName = Validation::check($_POST['lastName']);
    $description = Validation::check($_POST['description']);
    
    // if ($password === $passwordCheck) {
    //   $hashPassword = password_verify($password, $user->getPassword());
      // if ($hashPassword) {
        
        $attributes = [ 'email' => $email,
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'description' => $description,
                      ];
        $success = UserManager::updateOneRow('User', $userId, $attributes);
      // } 
      // }
      
    if ($success) {
      $_SESSION['flash']['success'] = 'Le compte à bien été modifié.';
      header("Location: /blog/user-$userId/show");
    } else {
      $_SESSION['flash']['danger'] = "Un ou plusieurs des champs n'est pas valide.";
      header("Location: /blog/user-$userId/edit");
    }
  }

  // public function adminDashboard() {
  //   // $this->render('admin/adminDashboard');
  // }
  
  // public function adminPostShow($postId) {
  //   // $this->render('admin/adminPostShow');
  // }

}