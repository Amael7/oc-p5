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

    // Get the title
    public function getTitle()
    {
        return $this->title;
    }
    
    // Set the title
    public function setTitle(string $title)
    {
        $this->title = $title;
        
        return $this;
    }
    
    // Get the subtitle
    public function getSubtitle()
    {
        return $this->subtitle;
    }
    
    // Set the subtitle
    public function setSubtitle(string $subtitle)
    {
        return $this->subtitle;

        return $this;
    }

    // get the content
    public function getContent()
    {
        return $this->content;
    }

    // set the content
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    // get the authorId
    public function getAuthorId()
    {
        return $this->authorId;
    }

    // set the authorId
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }
  }