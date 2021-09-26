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
  
  public static function create($className, $attributes = []) {
    $sql_column = [];
    $values = [];
    foreach($attributes as $k => $v) {
      $sql_column[] = "$k = ?";
      $values[] = $v;
    }
    // $values[] = $id;
    $sql_column = implode(', ', $sql_column);
    // return self::dbConnect()->query('INSERT INTO ' . self::getTableName($className) . ' ' . $sql_column, $values);
    // return self::dbConnect()->query('INSERT INTO Posts id = ?, title = ?, subtitle = ?, content = ?, author_id = 1, created_at = ?, updated_at = ?');
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