<?php

namespace App\Core;

class Controller
{

  protected $viewPath;
  protected $template;

  /**
   * function to render a view 
   *
   * @param string $view
   * @param array $params
   * @return void
   */
  public function render($view, $attributes = []) {
    ob_start();
    extract($attributes);
    require($this->viewPath . str_replace('.', '/', $view) . '.php'); // (/Users/stephanemontoro/code/Amael7/OpenClassrooms/public/Views/application/home.php)
    $content = ob_get_clean();
    require($this->viewPath . 'templates/' . $this->template . '.php');
  }
}