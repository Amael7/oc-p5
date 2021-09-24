<?php

namespace App\Controllers;

use App\Core\Controller;

class AppController extends Controller {


  protected $template = 'default';

  public function __construct() {
    $this->viewPath = '/Views/'; // ROOT . 
  }

  public function contact() {
    
  }

  public function contactForm() {

  }
  
  function home()
  {
    require('public/views/application/home.php');
  }

  function error404()
  {
    require('public/views/application/page404.php');
  }

}