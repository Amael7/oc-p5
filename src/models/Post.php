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
     * Get the subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }
    
    /**
     * Set the subtitle
     *
     * @param string $subtitle
     * @return string
     */
    public function setSubtitle(string $subtitle)
    {
        return $this->subtitle;

        return $this;
    }

    /**
     * get the content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * set the content
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
     * get the photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * set the photo
     *
     * @param string $photo
     * @return string
     */
    public function setPhoto(string $photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * get the author_id
     *
     * @return integer
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * set the author_id
     *
     * @param integer $author_id
     * @return integer
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

    /**
     * get the author fullname
     *
     * @return string
     */
    public function getAuthorName()
    {
        return \App\Manager\UserManager::getOne($this->author_id, "User")->getFullname();
    }
  }