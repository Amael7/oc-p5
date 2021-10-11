<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class AppController extends Controller {
  
  /**
   * function to render the home page view
   *
   * @return View
   */
  public function home()
  {
    $view = new View('Acceuil', 'application/home');
    $view->render();
  }

  /**
   * function to send the contact form through the Post method
   *
   * @return 
   */
  public function contact() {
    
  }

  /**
   * function to render the error 404 page view
   *
   * @return View
   */
  public function error404()
  {
    $view = new View('Page Introuvable', 'errors/404');
    $view->render();
  }

  /**
   * function to render the C.V page view
   *
   * @return View
   */
  public function cv() {
    $view = new View('Mon C.V', 'application/cv');
    $view->render();
  }
}