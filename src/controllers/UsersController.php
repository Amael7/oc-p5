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
  
  // public function create() {
    
  // }

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

  // public function update($id) {

  // }

  // public function adminDashboard() {
  //   // $this->render('admin/adminDashboard');
  // }
  
  // public function adminPostShow($postId) {
  //   // $this->render('admin/adminPostShow');
  // }

}