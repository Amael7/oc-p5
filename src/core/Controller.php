<?php

namespace App\Core;

class Controller
{

  protected $viewPath;
  protected $template;

  public function render($view) {
    ob_start();
    require($this->viewPath . str_replace('.', '/', $view) . 'php');
    $content = ob_end_clean();
    require($this->viewPath . 'templates/' . $this->template . 'php');
  }
}