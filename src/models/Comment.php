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
     * function to display the id with the parent protected method getId()
     *
     * @return int
     */
    public function id() {
        return $this->getId();
    }
  }