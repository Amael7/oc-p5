<?php

namespace App\Controllers;

use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Manager\CommentManager;
use App\Models\Comment;
use App\Core\Validation;
use App\Core\View;

class PostsController extends AppController {

  public function index() {
    $admin = false;
    if (isset($_SESSION['tokenAuth'])) {
      $admin = parent::checkUserAdmin($_SESSION['tokenAuth']);
    }
    $posts = PostManager::getAll("Post");
    $view = new View('Articles', 'posts/index');
    $view->render(compact('posts', 'admin'));
  }
  
  public function show($id) {
    $admin = false;
    $user = false;
    if (isset($_SESSION['tokenAuth'])) {
      $admin = parent::checkUserAdmin($_SESSION['tokenAuth']);
      $user = UserManager::getUserByTokenAuth($_SESSION['tokenAuth'], 'User');
    }
      $post = PostManager::getOne($id, "Post");

      // Comments waiting to be authorize by an admin
      $unvalidCommentsResult = CommentManager::getCommentsThroughValidBool($post->getId(), '0', 'Comment');
      $unvalidComments = Comment::displayComments($unvalidCommentsResult);
      
      // Valid Comments
      $validCommentsResult = CommentManager::getCommentsThroughValidBool($post->getId(), '1', 'Comment');
      $validComments = Comment::displayComments($validCommentsResult);

    $view = new View("Article n°$id", 'posts/show');
    $view->render(compact('post', 'admin', 'unvalidComments', 'validComments', 'user'));
  }
  
  public function new() {
    $admin = false;
    if (isset($_SESSION['tokenAuth'])) {
      $admin = parent::checkUserAdmin($_SESSION['tokenAuth']);
      if ($admin) {
        $users = UserManager::getAllAdmin('User');
        // dump($users);
        // exit;
        $view = new View('Nouvelle Article', 'posts/new');
        $view->render(compact('users', 'admin'));
      }
    } else {
      $_SESSION['flash']['danger'] = 'Page impossible d\'accès.';
      header('Location: /404');
    }
  }
  
  public function create() {
    $admin = false;
    if (isset($_SESSION['tokenAuth'])) {
      $admin = parent::checkUserAdmin($_SESSION['tokenAuth']);
      if ($admin) {
        $title = Validation::check($_POST['title']);
        $subTitle = Validation::check($_POST['subTitle']);
        $content = Validation::check($_POST['content']);
        $photo = Validation::check($_POST['photo']);
        $authorId = Validation::check($_POST['authorId']);
        $attributes = [ ':title' => $title,
                        ':subtitle' => $subTitle, 
                        ':content' => $content,
                        ':photo' => $photo,
                        ':author_id' => $authorId
                      ];
        $success = PostManager::addOneRow('Post', '(title, subtitle, content, photo, author_id)', '(:title, :subtitle, :content, :photo, :author_id)', $attributes);
        
        if ($success === true) {
          $_SESSION['flash']['success'] = 'Votre article à bien été ajouté.';
          header('Location: /blog');
        } else {
          $_SESSION['flash']['danger'] = "Impossible d'ajouter cette article.";
          header('Location: /blog/post/new');
        } 
      } else {
        $_SESSION['flash']['danger'] = 'Page impossible d\'accès.';
        header('Location: /404');
      }
    } else {
      $_SESSION['flash']['danger'] = 'Page impossible d\'accès.';
      header('Location: /404');
    }
  }
  
  public function edit($id) {
    $admin = false;
    if (isset($_SESSION['tokenAuth'])) {
      $admin = parent::checkUserAdmin($_SESSION['tokenAuth']);
      if ($admin) {
        $users = UserManager::getAll('User');
        $post = PostManager::getOne($id, "Post");
        $postId = $post->getId();
        $_POST['title'] =  $post->getTitle();
        $_POST['subTitle'] = $post->getSubtitle();
        $_POST['content'] = $post->getContent();
        $_POST['photo'] = $post->getPhoto();
        $_POST['authorId'] = $post->getAuthorId();
        $view = new View("Modification Article n°$postId", 'posts/edit');
        $view->render(compact('users', 'admin', 'postId'));
      } else {
        $_SESSION['flash']['danger'] = 'Page impossible d\'accès.';
        header('Location: /404');
      }
    } else {
      $_SESSION['flash']['danger'] = 'Page impossible d\'accès.';
      header('Location: /404');
    }
  }

  public function update($id) {
    $admin = false;
    if (isset($_SESSION['tokenAuth'])) {
      $admin = parent::checkUserAdmin($_SESSION['tokenAuth']);
      if ($admin) {
        $post = PostManager::getOne($id, "Post");
        $postId = $post->getId();
        $title = Validation::check($_POST['title']);
        $subTitle = Validation::check($_POST['subTitle']);
        $content = Validation::check($_POST['content']);
        $photo = Validation::check($_POST['photo']);
        $authorId = Validation::check($_POST['authorId']);
        $attributes = [ 'title' => $title,
                        'subtitle' => $subTitle, 
                        'content' => $content,
                        'photo' => $photo,
                        'author_id' => $authorId,
                      ];
        $success = PostManager::updateOneRow('Post', $postId, $attributes);
        
        if ($success === true) {
          $_SESSION['flash']['success'] = 'Votre article à bien été mis à jour.';
          header("Location: /blog/post-$postId");
        } else {
          $_SESSION['flash']['danger'] = 'Impossible de mettre à jour cette article.';
          header("Location: /blog/post-$postId/edit");
        }
      } else {
        $_SESSION['flash']['danger'] = 'Page impossible d\'accès.';
        header('Location: /404');
      }
    } else {
      $_SESSION['flash']['danger'] = 'Page impossible d\'accès.';
      header('Location: /404');
    }
  }

  public function destroy($id) {
    $admin = false;
    if (isset($_SESSION['tokenAuth'])) {
      $admin = parent::checkUserAdmin($_SESSION['tokenAuth']);
      if ($admin) {
        $successObj = CommentManager::deleteAllRowThroughItem('Comment', 'post_id', $id);
        $success = PostManager::deleteOneRow('Post', $id);

        if ($success === true) {
          $_SESSION['flash']['success'] = 'Votre article à bien été supprimé.';
          header('Location: /blog');
        } else {
          $_SESSION['flash']['danger'] = 'Impossible de supprimer cette article.';
          header('Location: /blog');
        }
      } else {
        $_SESSION['flash']['danger'] = 'Page impossible d\'accès.';
        header('Location: /404');
      }
    } else {
      $_SESSION['flash']['danger'] = 'Page impossible d\'accès.';
      header('Location: /404');
    }
  }
}