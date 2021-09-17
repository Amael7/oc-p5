<?php

namespace App\Manager;
use App\Models\User;


class UserManager extends AppManager {

  public static function getUsers() {
    return parent::dbConnect()->query('SELECT * FROM users');
  }

  public static function getUserById($userId) {
    $arr = parent::dbConnect()->query('SELECT * from users where id = ' . $userId );
    return $arr;
    $user = self::buildObject($arr);
    return $user;
  }

  private static function buildObject(array $array) {
    foreach($array as $row) {
      $user = new User();
      $user->setId($row['id']);
      $user->setFirstName($row['first_name']);
      $user->setLastName($row['last_name']);
      $user->setEmail($row['email']);
      $user->setPassword($row['password']);
      $user->SetDescription($row['description']);
      $user->SetAdmin($row['admin']);
    }
    return $user;
  }
}