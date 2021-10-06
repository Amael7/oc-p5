<?php

namespace App\Controllers;

use App\Manager\PostManager;
use App\Models\Post;
use App\Core\View;

class PostsController extends AppController {

  public function index() {
    $posts = PostManager::getAll("Post");
    $view = new View('Articles', 'posts/index');
    $view->render(compact('posts'));
  }
  
  public function show($id) {
    $post = PostManager::getOne($id, "Post");
    $postId = $post->getId();
    $view = new View("Article n°$postId", 'posts/show');
    $view->render(compact('post'));
  }
  
  public function new() {
    $view = new View('Nouvelle Article', 'posts/new');
    $view->render();
  }
  
  public function create() {
    // $post = $_POST;
    // $post = PostManager::create('Post', $post);
    // $post = PostManager::getOne($id, "Post");
  }
  
  public function edit($id) {
    // $post = PostManager::getOne($id, "Post");
    // $postId = $post->getId();
    // $view = new View('Modifier Article n°$postId', 'posts/edit');
    // $view->render(compact('post'));
  }

  public function update($id) {

  }

  public function destroy($id) {

  }
}