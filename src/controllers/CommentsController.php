<?php

namespace App\Controllers;

use App\Manager\CommentManager;
use App\Models\Comment;
use App\Core\Validation;
use App\Core\View;

class CommentsController extends AppController {

  // public function index() {

  // }

  // public function show($id) {

  // }

  public function new() {
    $view = new View('Nouveau commentaire', 'comments/new');
    $view->render();
  }

  public function create() {
    
  }

  public function edit($id) {
    $comment = CommentManager::getOne($id, "Comment");
    $commentId = $comment->getId();
    $_POST['title'] =  $comment->getTitle();
    $_POST['content'] = $comment->getContent();
    $_POST['authorId'] = $comment->getAuthorId();
    $view = new View('Modification commentaire', 'comments/edit');
    $view->render(compact('commentId'));
  }

  public function update($id) {

  }

  public function destroy($id) {

  }
}