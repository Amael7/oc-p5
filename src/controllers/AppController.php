<?php

namespace App\Controllers;

use App\Core\Controller;
// use App\Manager\UserManager;
// use App\Models\User;
// use App\Manager\PostManager;
// use App\Models\Post;
// use App\Manager\CommentManager;
// use App\Models\Comment;

class AppController extends Controller {


  protected $template = 'default';

  public function __construct() {
    $this->viewPath = ROOT . '/oc-p5/public/Views/'; // (/Users/stephanemontoro/code/Amael7/OpenClassrooms/public/Views/)
  }
  
  public function contact() {
    
  }
  
  public function contactForm() {
    
  }
  
  public function home()
  {
    $this->render('application/home'); // ('public/views/application/home.php')
  }

  public function error404()
  {
    require('public/views/application/page404.php');
  }

  // pourquoi pas faire un crud general ici pour ne pas le repeter sur chaque controller  ? 
}