<?php

  declare(strict_types=1);

  namespace App\Models;

  use App\Core\Model;

  class Post extends Model
  {
    private string $title;
    private string $subtitle;
    private string $content;
    private string $photo;
    private $authorId;

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
     * get the authorId
     *
     * @return void
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * set the authorId
     *
     * @param integer $authorId
     * @return void
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }
  }