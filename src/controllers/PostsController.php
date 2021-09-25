<?php

namespace App\Controllers;

use App\Manager\PostManager;
use App\Models\Post;

class PostsController extends AppController {

  public function index() {
    $this->render('posts/index');
  }

  public function show() {
    $this->render('posts/show');
  }
  
  public function new() {
    $this->render('posts/new');
  }
  
  public function create() {
    
  }
  
  public function edit() {
    $this->render('posts/edit');
  }

  public function update() {

  }

  public function destroy() {

  }
}