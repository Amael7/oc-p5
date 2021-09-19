<?php

namespace App\Manager;

class CommentManager extends AppManager {

  public static function getCommentByAuthor($authorId, $className) {
    return parent::dbConnect()->query('SELECT * from ' . parent::getTableName($className) . ' where author_id = ' . $authorId, parent::getClassName($className));
  }
}