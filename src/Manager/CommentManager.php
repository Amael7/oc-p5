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

  /**
   * function to get all comment with a valid boolean
   *
   * @param int $postId
   * @param int $validBool (0 = False, 1 = True)
   * @param string $className
   * @return array
   */
  public static function getCommentsThroughValidBool($postId, $validBool, $className) {
    return parent::dbConnect()->query('SELECT * FROM ' . parent::getTableName($className) . ' WHERE post_id = ' . $postId . ' AND valid = ' . $validBool, parent::getClassName($className));
  }
}