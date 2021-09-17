<?php

namespace App\Manager;

use App\Core\Database; 
use App\Model\User;
use App\Model\Post;
use App\Model\Comment;
// extends Database

class AppManager {

  private static $database;

  /**
   * function to connect to the Database
   *
   * @return object
   */
  public static function dbConnect() {
    if(self::$database === null) {
      /**
       * Load Dotenv to use .env va
       */
      \Dotenv\Dotenv::createImmutable(__DIR__); //->load(); // 
      self::$database = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
    }
    return self::$database;
  } 

  // public function buildObject(string $object, array $attributes) {
  //   $obj = new $object();
  //   $obj->setRow();
  // }
}