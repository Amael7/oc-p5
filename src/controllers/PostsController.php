<?php

namespace App\Controllers;

use App\Manager\PostManager;
use App\Models\Post;

class PostsController extends AppController {

  public function index() {
    $posts = PostManager::getAll("Post");
    $this->render('posts/index', compact('posts'));
  }
  
  public function show($id) {
    $post = PostManager::getOne($id, "Post");
    $this->render('posts/show', compact('post'));
  }
  
  public function new() {
    $this->render('posts/new');
  }
  
  public function create() {
    
  }
  
  public function edit($id) {
    $this->render('posts/edit');
  }

  public function update($id) {

  }

  public function destroy($id) {

  }

  // private function setParams() {

  // }
}