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
    return parent::dbConnect()->query('SELECT * FROM ' . parent::getTableName($className) . ' WHERE email = ' . "'$email'", parent::getClassName($className))[0];
  }

  /**
   * function to get one item by a token
   *
   * @param string $token
   * @param string $className
   * @return User
   */
  public static function getUserByTokenAuth($token, $className) {
    return parent::dbConnect()->query('SELECT * FROM ' . parent::getTableName($className) . ' WHERE token_auth = ' . "'$token'", parent::getClassName($className))[0];
  }

  /**
   * function to get one item by a token
   *
   * @param string $token
   * @param string $className
   * @return User
   */
  public static function getUserByToken($token, $tokenType, $className) {
    return parent::dbConnect()->query('SELECT * FROM ' . parent::getTableName($className) . ' WHERE ' . $tokenType . ' = ' . "'$token'", parent::getClassName($className));
  }

  /**
   * function to get one item by a tokenEmail
   *
   * @param string $token
   * @param string $className
   * @return User
   */
  public static function getUserByTokenEmail($token, $className) {
    return parent::dbConnect()->query('SELECT * FROM ' . parent::getTableName($className) . ' WHERE token_email_recuperation = ' . "'$token'", parent::getClassName($className))[0];
  }

  /**
   * function to update one row token to the db
   *
   * @param string $className
   * @param int $userId
   * @param array $attributes
   * @return
   */
  public static function updateOneTokenRow($className, $userId, $attributes = []) {
    $sql = 'UPDATE ' . self::getTableName($className) . ' SET ' . parent::setAttributesByString($attributes) . " WHERE id= " . $userId;
    $result = self::dbConnect()->prepare($sql, $attributes, $className);
    return $result;
  }


  /**
   * function to get all admin user in db
   *
   * @param string $className
   * @return array
   */
  public static function getAllAdmin($className) {
    return self::dbConnect()->query('SELECT * FROM ' . self::getTableName($className) . ' WHERE admin= 1', self::getClassName($className));
  }
}