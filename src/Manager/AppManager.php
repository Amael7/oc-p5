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
   * @return
   */
  public static function getOne($objId, $className) {
    return self::dbConnect()->query('SELECT * from ' . self::getTableName($className) . ' where id = ' . $objId, self::getClassName($className));
  }
  
  /**
   * function to add one row to the db to create something
   * example of how to use this function
   * PostManager::addOne('Post', '(title, subtitle, content, photo, author_id)', '(:title, :subtitle, :content, :photo, :author_id)', [':title' => $title, ':subtitle' => $subTitle, ':content' => $content,':photo' => $photo,':author_id' => $authorId]);
   *
   * @param string $className
   * @param string $sqlColumn
   * @param string $sqlColumnValue
   * @param array $attributes
   * @return
   */
  public static function addOneRow($className, $sqlColumn, $sqlColumnValue, $attributes = []) {
    $sql = 'INSERT INTO ' . self::getTableName($className) . ' ' . $sqlColumn . ' VALUES ' . $sqlColumnValue;
    $result = self::dbConnect()->prepare($sql, $attributes, $className);
    return $result;
  }

  // /**
  //  * function to update one row to the db to create something
  //  * example of how to use this function
  //  * PostManager::updateOneRow('Post', '(title, subtitle, content, photo, author_id)', '(:title, :subtitle, :content, :photo, :author_id)', [':title' => $title, ':subtitle' => $subTitle, ':content' => $content,':photo' => $photo,':author_id' => $authorId]);
  //     // UPDATE Posts SET title = :title, recipe = :recipe WHERE recipe_id = :id
  //  *
  //  * @param string $className
  //  * @param string $sqlColumn
  //  * @param string $sqlColumnValue
  //  * @param array $attributes
  //  * @return
  //  */
  // public static function updateOneRow($className, $sqlColumn, $sqlColumnValue, $attributes = []) {
  //   $sql = 'UPDATE ' . self::getTableName($className) . ' SET ' . $sqlColumn . ' VALUES ' . $sqlColumnValue;
  //   $result = self::dbConnect()->prepare($sql, $attributes, $className);
  //   return $result;
  // }

  /**
   * Function to destroy one row in the Database
   * example : PostManager::deleteOneRow('Post', $id);
   *
   * @param string $className
   * @param integer $id
   * @return
   */
  public static function deleteOneRow($className, $id) {
    $sql = 'DELETE FROM ' . self::getTableName($className) . ' WHERE id = ' . $id;
    $result = self::dbConnect()->prepare($sql, [$id], $className);
    return $result;
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
   * function to transform the classname into Table Name with '_id'
   *
   * @param string $className
   * @return string
   */
  protected static function getTableNameWithId(string $className) {
    return strtolower($className) . "_id";
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