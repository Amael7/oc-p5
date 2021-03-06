<?php

namespace App\Core;

class Config
{
    private $settings = [];
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    *
    * @param $file 
    **/
    public static function getInstance($file)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config($file);
        }
        return self::$_instance;
    }

    /**
    * Le constructeur avec sa logique est privé pour émpêcher l'instanciation en dehors de la classe
    *
    * @param $file 
    **/
    private function __construct($file)
    {
        $this->settings = require($file);
    }

    /**
    *  Permet d'obtenir la valeur de la configuration
    *  @param $key string clef à récupérer
    *  @return mixed
    **/
    public function get($key)
    {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}