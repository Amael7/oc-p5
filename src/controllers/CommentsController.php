<?php

namespace App\Controllers;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Models\Comment;
use App\Core\Validation;
use App\Core\View;

class CommentsController extends AppController {

  public function new($id) {
    $postId = $id;
    $view = new View('Nouveau commentaire', 'comments/new');
    $view->render(compact('postId'));
  }

  public function create($id) {
    $postId = $id;
    $title = Validation::check($_POST['title']);
    $content = Validation::check($_POST['content']);
    $authorId = Validation::check($_SESSION['user_auth']);
    $attributes = [ ':title' => $title,
                    ':content' => $content,
                    ':author_id' => $authorId,
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
    $authorId = Validation::check($_POST['authorId']);
    $attributes = [ 'title' => $title,
                    'content' => $content,
                    'author_id' => $authorId
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

  public function destroy($postId, $commentId) {
    $comment = CommentManager::getOne($commentId, "Comment");
    if ((isset($_SESSION['user_auth']) && ("{$_SESSION['user_auth']}" === $comment->getAuthorId()) || (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] === true))) {
      $success = CommentManager::deleteOneRow('Comment', $commentId);
      if ($success === true) {
        $_SESSION['flash']['success'] = 'Votre commentaire à bien été supprimé.';
        header("Location: /blog/post-$postId");
      } else {
        $_SESSION['flash']['danger'] = 'Impossible de supprimer ce commentaire.';
        header("Location: /blog/post-$postId");
      }
    } else {
      header("Location: /blog/post-$postId");
    }
  }

  public function validation($postId, $commentId) {
    $comment = CommentManager::getOne($commentId, "Comment");
    $bool = $comment->getValid() ? 0 : 1; # 0 = false, 1 = true
    if (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] === true) {
      $success = CommentManager::updateOneRow('Comment', $commentId, ['valid' => $bool]);
      if ($success === true) {
        $_SESSION['flash']['success'] = 'Votre commentaire à bien été supprimé.';
        header("Location: /blog/post-$postId");
      } else {
        $_SESSION['flash']['danger'] = 'Impossible de supprimer ce commentaire.';
        header("Location: /blog/post-$postId");
      }
    } else {
      header("Location: /blog/post-$postId");
    }
  }
}