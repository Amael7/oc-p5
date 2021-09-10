<?php

namespace App\Core;

class Database {

  private $db_name;
  private $db_user;
  private $db_pass;
  private $db_host;

  public function __construct($db_name, $db_user = 'root', $db_pass = 'root', $db_host = 'localhost') {

  }

  public function getPdo() {

  }

  public function request($query) {

  }

}