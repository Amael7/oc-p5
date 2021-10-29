<?php

namespace App\Controllers;

use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Models\Post;
use App\Core\Validation;
use App\Core\View;
use App\Manager\CommentManager;

class PostsController extends AppController {

  public function index() {
    $posts = PostManager::getAll("Post");
    $view = new View('Articles', 'posts/index');
    $view->render(compact('posts'));
  }
  
  public function show($id) {
    // Post informations
      $post = PostManager::getOne($id, "Post");
      $postAuthor = UserManager::getOne($post->getAuthorId(), "User");
      $postId = $post->getId();
      $postCreatedAt = $post->displayDateTime($post->getCreatedAt());

    // Comment informations
      $comments = CommentManager::getAllThroughObject('Comment', 'post_id', $postId);
      $commentsAttributes = [];
      foreach($comments as $comment) {
        $commentAuthor = UserManager::getOne($comment->getAuthorId(), "User");
        $commentCreatedAt = $comment->displayDateTime($comment->getCreatedAt());
        $attributes = [
          'comment' => $comment,
          'commentAuthorFullname' => $commentAuthor->getFullname(),
          'commentCreatedAt' => $commentCreatedAt
        ];
        array_push($commentsAttributes, $attributes);
      };

    $view = new View("Article n°$postId", 'posts/show');
    $view->render(compact('post', 'postAuthor', 'postCreatedAt', 'commentsAttributes'));
  }
  
  public function new() {
    $users = UserManager::getAll('User');
    $view = new View('Nouvelle Article', 'posts/new');
    $view->render(compact('users'));
  }
  
  public function create() {
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
      $_SESSION['flash']['success'] = 'Votre article à bien été ajouter.';
      header('Location: /blog');
    } else {
      $_SESSION['flash']['danger'] = 'Impossible d\'ajouter cette article.';
      header('Location: /blog/post/new');
    }
  }
  
  public function edit($id) {
    $users = UserManager::getAll('User');
    $post = PostManager::getOne($id, "Post");
    $postId = $post->getId();
    $_POST['title'] =  $post->getTitle();
    $_POST['subTitle'] = $post->getSubtitle();
    $_POST['content'] = $post->getContent();
    $_POST['photo'] = $post->getPhoto();
    $_POST['authorId'] = $post->getAuthorId();
    $view = new View("Modification Article n°$postId", 'posts/edit');
    $view->render(compact('users', 'postId'));
  }

  public function update($id) {
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
      header('Location: /blog');
    } else {
      $_SESSION['flash']['danger'] = 'Impossible de mettre à jour cette article.';
      header('Location: /blog/post/edit');
    }
  }

  public function destroy($id) {
    $success = PostManager::deleteOneRow('Post', $id);

    if ($success === true) {
      $_SESSION['flash']['success'] = 'Votre article à bien été supprimé.';
      header('Location: /blog');
    } else {
      $_SESSION['flash']['danger'] = 'Impossible de supprimer cette article.';
      header('Location: /blog');
    }
  }
}