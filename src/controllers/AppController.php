<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class AppController extends Controller {

  public function contact() {
    
  }
  
  public function home()
  {
    $view = new View('Acceuil', 'application/home');
    $view->render();
  }

  public function error404()
  {
    $view = new View('Page Introuvable', 'errors/404');
    $view->render();
  }

  public function cv() {
    // $this->render('application/cv');
  }

}