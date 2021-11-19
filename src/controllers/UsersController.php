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
    // chercher le user
    $view = new View('Mon profil', 'users/show');
    $view->render();
  }
  
  public function edit($id) {
    // chercher le user
    $view = new View('Modification de compte', 'users/edit');
    $view->render();
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