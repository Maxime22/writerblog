<?php
namespace Entity;

use \MiniFram\Entity;

class Chapter extends Entity
{
    protected $author;
    protected $title;
    protected $content;
    protected $addDate;
    protected $modifDate;

    const AUTHOR_INVALID = 1;
    const TITLE_INVALID = 2;
    const CONTENT_INVALID = 3;

    public function isValid()
    {
        return !(empty($this->author) || empty($this->title) || empty($this->content));
    }

    // SETTERS

    public function setAuthor($author)
    {
        if (!is_string($author) || empty($author)) {
            $this->errors[] = self::AUTHOR_INVALID;
        }

        $this->author = $author;
    }

    public function setTitle($title)
    {
        if (!is_string($title) || empty($title)) {
            $this->errors[] = self::TITLE_INVALID;
        }

        $this->title = $title;
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content)) {
            $this->errors[] = self::CONTENT_INVALID;
        }

        $this->content = $content;
    }

    public function setAddDate(\DateTime $addDate)
    {
        $this->addDate = $addDate;
    }

    public function setModifDate(\DateTime $modifDate)
    {
        $this->modifDate = $modifDate;
    }

    // GETTERS

    public function author()
    {
        return $this->author;
    }

    public function title()
    {
        return $this->title;
    }

    public function content()
    {
        return $this->content;
    }

    public function addDate()
    {
        return $this->addDate;
    }

    public function modifDate()
    {
        return $this->modifDate;
    }
}
