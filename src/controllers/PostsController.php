<?php

namespace App\Controllers;

use App\Manager\PostManager;
use App\Models\Post;
use App\Core\Validation;
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
    $title = Validation::check($_POST['title']);
    $subTitle = Validation::check($_POST['subTitle']);
    $content = Validation::check($_POST['content']);
    $photo = Validation::check($_POST['photo']);
    // $authorId = ; // Pour recuperer l'author de l'article, il faudras adapter cela lorsque on aura la partie connexion de faite.
    $attributes = [ ':title' => $title,
                    ':subtitle' => $subTitle, 
                    ':content' => $content,
                    ':photo' => $photo,
                    ':author_id' => 1 # à changer quand j'aurais recup l'authorId
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
    $post = PostManager::getOne($id, "Post");
    $postId = $post->getId();
    $_POST['title'] =  $post->getTitle();
    $_POST['subTitle'] = $post->getSubtitle();
    $_POST['content'] = $post->getContent();
    $_POST['photo'] = $post->getPhoto();
    $_POST['authorId'] = $post->getAuthorId();


    $view = new View("Modification Article n°$postId", 'posts/edit');
    $view->render();
  }

  public function update($id) {
    $post = PostManager::getOne($id, "Post");
    $postId = $post->getId();
    $title = Validation::check($_POST['title']);
    $subTitle = Validation::check($_POST['subTitle']);
    $content = Validation::check($_POST['content']);
    $photo = Validation::check($_POST['photo']);
    // $authorId = ; // Pour recuperer l'author de l'article, il faudras adapter cela lorsque on aura la partie connexion de faite.
    $attributes = [ ':title' => $title,
                    ':subtitle' => $subTitle, 
                    ':content' => $content,
                    ':photo' => $photo,
                    ':id' => $postId,
                    ':author_id' => 1 # à changer quand j'aurais recup l'authorId
                  ];

    $success = PostManager::updateOneRow('Post', '(title, subtitle, content, photo, author_id)', '(:title, :subtitle, :content, :photo, :author_id)', $attributes);
    
    if ($success === true) {
      $_SESSION['flash']['success'] = 'Votre article à bien été ajouter.';
      header('Location: /blog');
    } else {
      $_SESSION['flash']['danger'] = 'Impossible d\'ajouter cette article.';
      header('Location: /blog/post/new');
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