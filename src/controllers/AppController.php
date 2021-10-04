<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View\View;

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
    // $this->render('errors/404');
  }

  public function cv() {
    // $this->render('application/cv');
  }

}