<?php

  declare(strict_types=1);

  namespace App\Models;

  class Form 
  {
    
    private $data;
    public $surround = 'p';

    /**
     * function to construct the form and give him array data 
     *
     * @param array $data
     */
    public function __construct($data = array()) {
      $this->data = $data;
    }

    /**
     * function to surround some html
     *
     * @param string $html string code html to surround
     * @return string
     */
    private function surround($html) {
      return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    /**
     * function to get a value with an index
     *
     * @param int $index
     * @return string
     */
    private function getValue($index) {
      if(is_object($this->data)) {
        return $this->data->$index;
      }
      return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    
    /**
     * function to enter create an input
     *
     * @param string $name
     * @param string $label
     * @param array $options
     * @return string
     */
    public function input($name, $label, $options = []) {
      $type = isset($options['type']) ? $options['type'] : 'text';
      $label = '<label>' . $label . '</label>';
      if($type === 'textarea') {
        return $input = '<textarea name="' . $name . '" class="form-control">' . $this->getValue($name) . '</textarea>';
      } else {
        dump($this->getValue($name));
        return $input = '<input type="' . $type . '" name="' . $name . '" value="' .  $this->getValue($name) . '" class="form-control">';
      }
    }
    
    /**
     * function to create a submit button
     *
     * @param string $value
     * @return string
     */
    public function submit($value) {
      return "<button type='submit'>$value</button>";
    }
    
    /**
     * function to enter a password
     *
     * @param string $name
     * @return string
     */
    public function password($name) {
      return $this->surround(
        '<iput type="password" name="' . $name . '" value="' . $this->getValue($name)
      );
    }
  }
  