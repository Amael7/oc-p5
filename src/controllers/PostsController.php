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
    // dump($_POST);
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

    // ensuite on lance la request 
    $post = PostManager::addOneRow('Post', '(title, subtitle, content, photo, author_id)', '(:title, :subtitle, :content, :photo, :author_id)', $attributes);
    dump($post);
    // count if 0 object === vide
    // et si le save fonctionne on va mettre un message flash qui dit création avec success et on reconduit sur l'index des post 
    // sinon on mets un message flash pour dire que les champs ne sont pas correct et on render à nouveau notre formulaire
    if ($post === true) {
      $_SESSION['flash']['success'] = 'Votre article à bien été ajouter.';
      header('Location: /blog');
      } else {
          $_SESSION['flash']['danger'] = 'Impossible d\'ajouter cette article.';
      header('Location: /blog/post/new');
    }
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