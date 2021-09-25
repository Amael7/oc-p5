<?php

namespace App\Controllers;

use App\Manager\UserManager;
use App\Models\User;

class UsersController extends AppController {

  public function new() {
    $this->render('users/new');
  }

  public function show($id) {
    $this->render('users/show');
  }

  public function create() {

  }

  public function edit($id) {
    $this->render('users/edit');
  }

  public function update($id) {

  }

  public function connectionView() {
    $this->render('users/connection');
  }

  public function login() {

  }

  public function logout() {

  }

  public function adminDashboard() {
    $this->render('admin/adminDashboard');
  }
  
  public function adminPostShow($postId) {
    $this->render('admin/adminPostShow');
  }

}