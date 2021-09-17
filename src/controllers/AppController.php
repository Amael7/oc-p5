<?php

namespace App\Controllers;

use App\Core\Controller;

class AppController extends Controller {

  function home()
  {
    require('public/views/application/home.php');
  }

  function errorPage404()
  {
    require('public/views/application/page404.php');
  }

}