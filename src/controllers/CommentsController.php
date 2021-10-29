<?php

namespace App\Controllers;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Models\Comment;
use App\Core\Validation;
use App\Core\View;

class CommentsController extends AppController {

  // public function index() {

  // }

  // public function show($id) {

  // }

  public function new($id) {
    $postId = $id;
    $view = new View('Nouveau commentaire', 'comments/new');
    $view->render(compact('postId'));
  }

  public function create($id) {
    $postId = $id;
    $title = Validation::check($_POST['title']);
    $content = Validation::check($_POST['content']);
    // $authorId = Validation::check($_POST['authorId']); we need to fetch the user id when we'll have the admin/login system
    $attributes = [ ':title' => $title,
                    ':content' => $content,
                    ':author_id' => 1,
                    ':post_id' => $postId
                  ];

    $success = CommentManager::addOneRow('Comment', '(title, content, author_id, post_id)', '(:title, :content, :author_id, :post_id)', $attributes);
    
    if ($success === true) {
      $_SESSION['flash']['success'] = 'Votre commentaire à bien été ajouté.';
      header("Location: /blog/post-$postId");
    } else {
      $_SESSION['flash']['danger'] = 'Impossible d\'ajouter votre commentaire.';
      header("Location: /blog/post-$postId/comment/new");
    }
  }

  public function edit($id, $commentId) {
    $comment = CommentManager::getOne($commentId, "Comment");
    $commentId = $comment->getId();
    $postId = $comment->getPostId();
    $_POST['title'] =  $comment->getTitle();
    $_POST['content'] = $comment->getContent();
    $_POST['authorId'] = $comment->getAuthorId();
    $view = new View('Modification commentaire', 'comments/edit');
    $view->render(compact('postId', 'commentId'));
  }

  public function update($postId, $commentId) {
    $title = Validation::check($_POST['title']);
    $content = Validation::check($_POST['content']);
    // $authorId = Validation::check($_POST['authorId']); we need to fetch the user id when we'll have the admin/login system
    $attributes = [ ':title' => $title,
                    ':content' => $content,
                  ];
    $success = CommentManager::updateOneRow('Comment', $commentId, $attributes);
    
    if ($success === true) {
      $_SESSION['flash']['success'] = 'Votre commentaire à bien été mis à jour.';
      header("Location: /blog/post-$postId");
    } else {
      $_SESSION['flash']['danger'] = 'Impossible de mettre à jour votre commentaire.';
      header("Location: /blog/post-$postId/comment-$commentId/edit");
    }
  }

  public function destroy($id) {

  }
}