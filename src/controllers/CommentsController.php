<?php

namespace App\Controllers;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Models\Comment;
use App\Core\Validation;
use App\Core\View;
use App\Manager\UserManager;

class CommentsController extends AppController {

  public function new($id) {
    if (isset($_SESSION['tokenAuth'])) {
      $admin = parent::checkUserAdmin($_SESSION['tokenAuth']);
      $postId = $id;
      $view = new View('Nouveau commentaire', 'comments/new');
      $view->render(compact('postId', 'admin'));
    }
  }

  public function create($id) {
    if (isset($_SESSION['tokenAuth'])) {
      $postId = $id;
      $title = Validation::check($_POST['title']);
      $content = Validation::check($_POST['content']);
      $user = UserManager::getUserByTokenAuth($_SESSION['tokenAuth'], 'User');
      $authorId = Validation::check($user->getId());
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
  }

  // public function edit($id, $commentId) {
  //   $comment = CommentManager::getOne($commentId, "Comment");
  //   $commentId = $comment->getId();
  //   $postId = $comment->getPostId();
  //   $_POST['title'] =  $comment->getTitle();
  //   $_POST['content'] = $comment->getContent();
  //   $_POST['authorId'] = $comment->getAuthorId();
  //   $view = new View('Modification commentaire', 'comments/edit');
  //   $view->render(compact('postId', 'commentId'));
  // }

  // public function update($postId, $commentId) {
  //   $title = Validation::check($_POST['title']);
  //   $content = Validation::check($_POST['content']);
  //   $authorId = Validation::check($_POST['authorId']);
  //   $attributes = [ 'title' => $title,
  //                   'content' => $content,
  //                   'author_id' => $authorId
  //                 ];
  //   $success = CommentManager::updateOneRow('Comment', $commentId, $attributes);
  //   if ($success === true) {
  //     $_SESSION['flash']['success'] = 'Votre commentaire à bien été mis à jour.';
  //     header("Location: /blog/post-$postId");
  //   } else {
  //     $_SESSION['flash']['danger'] = 'Impossible de mettre à jour votre commentaire.';
  //     header("Location: /blog/post-$postId/comment-$commentId/edit");
  //   }
  // }

  public function destroy($postId, $commentId) {
    if (isset($_SESSION['tokenAuth'])) {
      $admin = parent::checkUserAdmin($_SESSION['tokenAuth']);
      $user = UserManager::getUserByTokenAuth($_SESSION['tokenAuth'], 'User');
      $comment = CommentManager::getOne($commentId, "Comment");
      if (($user->getId() === $comment->getAuthorId()) || $admin) {
        $success = CommentManager::deleteOneRow('Comment', $commentId);
        if ($success) {
          $_SESSION['flash']['success'] = 'Votre commentaire à bien été supprimé.';
          header("Location: /blog/post-$postId");
        } else {
          $_SESSION['flash']['danger'] = 'Impossible de supprimer ce commentaire.';
          header("Location: /blog/post-$postId");
        }
      } else {
        $_SESSION['flash']['danger'] = 'Impossible de supprimer ce commentaire.';
        header("Location: /blog/post-$postId");
      }
    }
  }

  public function validation($postId, $commentId) {
    if (isset($_SESSION['tokenAuth'])) {
      $admin = parent::checkUserAdmin($_SESSION['tokenAuth']);
      if ($admin) {
        $comment = CommentManager::getOne($commentId, "Comment");
        $bool = $comment->getValid() ? 0 : 1; # 0 = false, 1 = true
        $success = CommentManager::updateOneRow('Comment', $commentId, ['valid' => $bool]);
        if ($success) {
          $_SESSION['flash']['success'] = 'Votre commentaire à bien été supprimé.';
          header("Location: /blog/post-$postId");
        } else {
          $_SESSION['flash']['danger'] = 'Impossible de supprimer ce commentaire.';
          header("Location: /blog/post-$postId");
        }
      } else {
        $_SESSION['flash']['danger'] = "Aucun accès à cette page.";
        header("Location: /blog/post-$postId");
      }
    } else {
      $_SESSION['flash']['danger'] = "Aucun accès à cette page.";
      header("Location: /blog/post-$postId");
    }
  }
}