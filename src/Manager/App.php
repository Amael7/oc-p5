<?php

namespace App\Manager;

use App\Core\Database;
use Symfony\Component\Dotenv\Dotenv;

class AppManager extends Database {

  const DB_NAME = '';
  const DB_USER = '';
  const DB_PASS = '';
  const DB_HOST = '';

  private static $database;

  /**
   * function to get the Database
   *
   * @return object
   */
  public static function getDB() {
    if(self::$database === null) {
      $dotenv = new Dotenv();
      $dotenv->load(__DIR__.'/.env');
      self::$database = new Database($_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_HOST']);
    }
    return self::$database;
  } 
}