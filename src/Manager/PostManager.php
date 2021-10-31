<?php

namespace App\Manager;

class PostManager extends AppManager {

  /**
   * function to get a post by his author
   *
   * @param integer $authorId
   * @param string $className
   * @return Post
   */
  public static function getPostByAuthor($authorId, $className) {
    return parent::dbConnect()->query('SELECT * from ' . parent::getTableName($className) . ' where author_id = ' . $authorId, parent::getClassName($className));
  }
}