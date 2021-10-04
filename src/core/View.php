<?php

namespace App\Core\View;

class View {

  public $defaultPath = ROOT . '/oc-p5/public/views/';
  public $layout = 'default';
  public $title;
  public $viewPath;

  public function __construct($title, $viewPath)
  {
    $this->setTitle($title);
    $this->setViewPath($viewPath); // (/Users/stephanemontoro/code/Amael7/OpenClassrooms/public/Views/)
  }

  // Getters and Setters

  public function getTitle()
  {
    return $this -> title;
  }

  public function setTitle($title)
  {
    $this -> title = $title;
  }

  public function getDefaultPath()
  {
    return $this -> defaultPath;
  }

  public function setDefaultPath($defaultPath)
  {
    $this -> defaultPath = $defaultPath;
  }

  public function getViewPath()
  {
    return $this -> ViewPath;
  }

  public function setViewPath($ViewPath)
  {
    $this -> ViewPath = $ViewPath;
  }

  public function getLayout()
  {
    return $this -> layout;
  }

  public function setLayout($layout)
  {
    $this -> layout = $layout;
  }

  /**
   * function to render a view 
   *
   * @param string $view
   * @param array $params
   * @return void
   */
  public function render($attributes = []) {
    ob_start();
    if(!is_null($attributes)) {
      extract($attributes);
    } 
    require($this->defaultPath . str_replace('.', '/', $this->getViewPath()) . '.php'); // (/Users/stephanemontoro/code/Amael7/OpenClassrooms/public/Views/application/home.php)
    $content = ob_get_clean();
    require($this->viewPath . 'templates/' . $this->template . '.php');
  }

}