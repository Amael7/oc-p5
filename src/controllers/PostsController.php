<?php

namespace App\Controllers;

use App\Manager\PostManager;
use App\Models\Post;
use App\Models\Form;

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
    $form = new Form($_POST);
    $this->render('posts/new', compact('form'));
  }
  
  public function create() {
    // $post = $_POST;
    // $post = PostManager::create('Post', $post);
    // $post = PostManager::getOne($id, "Post");
    // $this->render('posts/show', compact('post'));
  }
  
  public function edit($id) {
    $this->render('posts/edit');
  }

  public function update($id) {

  }

  public function destroy($id) {

  }
}