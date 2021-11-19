<?php

namespace App\Manager;

class UserManager extends AppManager {

    /**
   * function to get a boolean through Users by checking one attributes
   *
  //  * @param array $attributes
   * @param string $attribute
   * @return boolean
   */
  // public static function getUserByEmailAndPassword($attributes) {
    // $sql = "SELECT * FROM Users (email, password) VALUES (:email, password)";
  //   return parent::dbConnect()->prepare($sql, $attributes, 'User');
  // }
  public static function checkUserByAttribute($attributes, $sql_attribute) {
    $sql = "SELECT * FROM Users WHERE $sql_attribute = :$sql_attribute";
    return parent::dbConnect()->prepare($sql, [":$sql_attribute" => $attributes], 'User');
  }

  /**
   * function to get a user by one attributes
   *
   * @param string $email
   * @param string $className
   * @return User
   */
  public static function getUserByEmail($email, $className) {
    return parent::dbConnect()->query('SELECT * FROM ' . parent::getTableName($className) . ' WHERE email = ' . "'$email'", parent::getClassName($className));
  }
}