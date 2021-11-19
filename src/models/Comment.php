<?php

  declare(strict_types=1);

  namespace App\Models;

  use App\Core\Model;

  class Comment extends Model
  {
    private string $title;
    private string $content;
    private $post_id;
    private $author_id;

    /**
     * Get the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set the title
     *
     * @param string $title
     * @return string
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        
        return $this;
    }

    /**
     * Get the content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * Set the content
     *
     * @param string $content
     * @return string
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        
        return $this;
    }

    /**
     * get the post_id
     *
     * @return void
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * set the post_id
     *
     * @param integer $post_id
     * @return void
     */
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;

        return $this;
    }

    /**
     * get the author_id
     *
     * @return void
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * set the author_id
     *
     * @param integer $author_id
     * @return void
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;

        return $this;
    }

    /**
     * get the author fullname
     *
     * @return string
     */
    public function getAuthorName()
    {
        return \App\Manager\UserManager::getOne($this->author_id, "User")->getFullname();
    }

    /**
     * function who take a sql response as parameter and check all possibly cases to allow us to display correctly if a post has comments
     *
     * @param $comments
     * @return
     */
    public static function displayComments($comments) {
        $commentsAttributes = [];
        
        if (isset($comments) && $comments == []) {
            // si ya 0 comm
            $commentsAttributes = null;
        } 
        else if (isset($comments) && is_iterable($comments) == false && get_class($comments) == "App\Models\Comment") {
            // si ya 1 comm => un object de ce type là : "App\Models\Comment"
            $attributes = [
            'comment' => $comments,
            'commentAuthorFullname' => $comments->getAuthorName(),
            'commentCreatedAt' => $comments->displayDateTime($comments->getCreatedAt())
            ];
            array_push($commentsAttributes, $attributes);
        } 
        else if (isset($comments) && is_countable($comments) && count($comments) >= 1) {
            // si ya plus de 1 comm => un array avec des items à l'interieur de type : "App\Models\Comment"
            foreach($comments as $comment) {
                $attributes = [
                    'comment' => $comment,
                    'commentAuthorFullname' => $comment->getAuthorName(),
                    'commentCreatedAt' => $comment->displayDateTime($comment->getCreatedAt())
                ];
                array_push($commentsAttributes, $attributes);
            };
        }
        return $commentsAttributes;
    }
  }