<?php

namespace App\Manager;

class CommentManager extends AppManager {

  /**
   * function to get a comment by his author
   *
   * @param integer $authorId
   * @param string $className
   * @return Comment
   */
  public static function getCommentByAuthor($authorId, $className) {
    return parent::dbConnect()->query('SELECT * FROM ' . parent::getTableName($className) . ' WHERE author_id = ' . $authorId, parent::getClassName($className));
  }
}