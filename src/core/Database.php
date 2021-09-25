<?php

namespace App\Core;

use \PDO;

class Database {

  private $db_name;
  private $db_user;
  private $db_pass;
  private $db_host;
  private $pdo;

  /**
   * function when an instance is created for setup the db credits
   *
   * @param string $db_name
   * @param string $db_user
   * @param string $db_pass
   * @param string $db_host
   */
  public function __construct($db_host, $db_name, $db_user, $db_pass) {
    $this->db_host = $db_host;
    $this->db_name = $db_name;
    $this->db_user = $db_user;
    $this->db_pass = $db_pass;
  }

  /**
   * function to create a connection to the db
   *
   * @return object
   */
  public function getPDO() {
    if($this->pdo === null) {
      $pdo = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';', $this->db_user, $this->db_pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo = $pdo;
    }
    return $this->pdo;
  }

  /**
   * function to give an sql query 
   *
   * @param string $query
   * @return object
   */
  public function query($query, $class_name) {
    $req = $this->getPDO()->query($query);
    while($data = $req->fetchObject($class_name)) {
      $datas[] = $data;
    }
    if(count($datas) === 1 ) {
      return $datas[0];
    }
    return $datas;
  }

  /**
   * function to call an sql request with attributes and protected from sql injection
   *
   * @param string $query
   * @param array $attributes
   * @param string $class_name
   * @return void
   */
  public function prepare($query, $attributes, $class_name, $one = false) {
    $req = $this->getPDO()->prepare($query);
    $req->execute($attributes);
    $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    if($one) {
      $datas = $req->fetch();
    } else {
      $datas = $req->fetchAll();
    }
    return $datas;
  }
}