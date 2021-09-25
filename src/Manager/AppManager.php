<?php

namespace App\Manager;

use App\Core\Database; 

class AppManager {

  private static $database;

  /**
   * function to get all item in db
   *
   * @param string $className
   * @return array
   */
  public static function getAll($className) {
    return self::dbConnect()->query('SELECT * FROM ' . self::getTableName($className) , self::getClassName($className));
  }

  /**
   * function to get one item by id in db
   *
   * @param integer $objId
   * @param string $className
   * @return void
   */
  public static function getOne($objId, $className) {
    return self::dbConnect()->query('SELECT * from ' . self::getTableName($className) . ' where id = ' . $objId, self::getClassName($className));
  }

  /**
   * function to connect to the Database
   *
   * @return object
   */
  protected static function dbConnect() {
    if(self::$database === null) {
      /**
       * Load Dotenv to use .env va
       */
      self::$database = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
    }
    return self::$database;
  } 

  /**
   * function to transform the classname into Table Name
   *
   * @param string $className
   * @return string
   */
  protected static function getTableName(string $className) {
    return $className . "s";
  }

  /**
   * function to transform the classname into Full Class Name
   *
   * @param string $className
   * @return string
   */
  protected static function getClassName(string $className) {
    return "App\Models\\" . $className;
  }
}