<?php

namespace App\Controller;

use App\Core\Controller;

class UsersController extends Controller {

  function home()
  {
    require('src/views/application/home.php');
  }

  function errorPage404()
  {
    require('src/views/application/page404.php');
  }

}