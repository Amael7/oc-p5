<?php

namespace App\Manager;

class CommentManager extends AppManager {

  /**
   * function to get a comment by his author
   *
   * @param integer $authorId
   * @param string $className
   * @return void
   */
  public static function getCommentByAuthor($authorId, $className) {
    return parent::dbConnect()->query('SELECT * from ' . parent::getTableName($className) . ' where author_id = ' . $authorId, parent::getClassName($className));
  }
}