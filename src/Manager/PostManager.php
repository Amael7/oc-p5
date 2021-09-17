<?php

namespace App\Manager;

class PostManager extends AppManager {

  public static function getPosts() {
    return parent::dbConnect()->query('SELECT * FROM users');
  }

  public static function getPostById($postId) {
    return parent::dbConnect()->query('SELECT * from users where id = ' . $postId );
  }

  public static function getPostByAuthor($authorId) {
    return parent::dbConnect()->query('SELECT * from users where author_id = ' . $authorId );
  }
}