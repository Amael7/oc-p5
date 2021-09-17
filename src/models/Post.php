<?php

  declare(strict_types=1);

  namespace App\Models;

  use App\Core\Model;

  class Post extends Model
  {
    private string $title;
    private string $subtitle;
    private string $content;
    private $photo;
    private $author_id;

    /**
     * Get the title
     *
     * @return void
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        
        return $this;
    }
    
    /**
     * Get the subtitle
     *
     * @return void
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }
    
    /**
     * Set the subtitle
     *
     * @param string $subtitle
     * @return void
     */
    public function setSubtitle(string $subtitle)
    {
        return $this->subtitle;

        return $this;
    }

    /**
     * get the content
     *
     * @return void
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * set the content
     *
     * @param string $content
     * @return void
     */
    public function setContent(string $content)
    {
        $this->content = $content;

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
  }